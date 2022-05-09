<?php

namespace App\Http\Livewire\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class UserController extends Component
{
    use AuthorizesRequests;
    use PasswordValidationRules;
    use WithPagination;

    public User $user;
    public string $role = '';
    public string $password = '';
    public string $password_confirmation = '';

    public int $perPage = 5;
    public string $search = '';
    public string $sortField = 'id';
    public string $sortDirection = 'asc';

    public bool $showEditCreateModal = false;
    public bool $showViewModal = false;
    public bool $showConfirmationModal = false;
    public bool $edit = false;
    public bool $delete = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDirection',
    ];

    public function rules(): array
    {
        if ($this->edit) {
            return [
                'user.name' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
                'user.apellido_paterno' => ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
                'user.apellido_materno' => ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
                'user.email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
                'password' => array_replace($this->passwordRules(), [0 => 'present']),
                'password_confirmation' => ['present'],
            ];
        }

        return [
            'user.name' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.apellido_paterno' => ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.apellido_materno' => ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => $this->passwordRules(),
            'password_confirmation' => ['required'],
        ];
    }

    public function mount()
    {
        $this->blankUser();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy(string $field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function blankUser()
    {
        $this->user = User::make();
        $this->reset(['role', 'password', 'password_confirmation']);
    }

    public function create()
    {
        $this->authorize('user.create');

        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->blankUser();

        $this->edit = false;
        $this->delete = false;
        $this->showEditCreateModal = true;
    }

    public function edit(User $user)
    {
        $this->authorize('user.edit');

        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->user = $user;
        $this->role = $user->getRoleNames()->first() ?? '';

        $this->edit = true;
        $this->delete = false;
        $this->showEditCreateModal = true;
    }

    public function delete(User $user)
    {
        $this->authorize('user.delete');

        $this->user = $user;

        $this->edit = false;
        $this->delete = true;
        $this->showConfirmationModal = true;
    }

    public function confirmSave()
    {
        $this->validate();
        $this->showConfirmationModal = true;
    }

    public function save()
    {
        if (Hash::check($this->password, $this->user->password) || ! $this->password) {
            $this->user->update([
                'name' => $this->user->name,
                'email' => $this->user->email,
            ]);
            $this->user->syncRoles($this->role);
        } else {
            $this->user->password = Hash::make($this->password);
            $this->user->syncRoles($this->role);
            $this->user->save();
        }

        $this->showConfirmationModal = false;
        $this->showEditCreateModal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' => $this->edit ? 'Usuario actualizado exitosamente' : 'Usuario creado exitosamente',
        ]);
    }

    public function destroy()
    {
        $this->user->delete();
        $this->showConfirmationModal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' => 'Usuario eliminado exitosamente',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.users.index', [
            'users' => User::query()
                ->when($this->search, function ($query, $search) {
                    $query->where(DB::raw("REPLACE(CONCAT_WS(' ', name, apellido_paterno, apellido_materno), '  ', ' ')"), 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                })
                ->when($this->sortField === 'nombre_completo', function ($query) {
                    $query->orderByRaw("REPLACE(CONCAT_WS(' ', name, apellido_paterno, apellido_materno), '  ', ' ') $this->sortDirection");
                }, function ($query) {
                    $query->orderBy($this->sortField, $this->sortDirection);
                })
                ->paginate($this->perPage),
        ]);
    }
}
