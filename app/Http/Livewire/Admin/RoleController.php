<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleController extends Component
{
    use WithPagination;

    public Role $role;
    public array $permissions = [];
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

    protected array $rules = [
        'role.name' => ['required'],
    ];

    public function mount(): void
    {
        $this->blankRole();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function blankRole(): void
    {
        $this->role = Role::make();
    }

    public function create(): void
    {
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->blankRole();
        $this->permissions = [];

        $this->edit = false;
        $this->delete = false;
        $this->showEditCreateModal = true;
    }

    public function edit(Role $role): void
    {
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->role = $role;
        $this->permissions = $this->getPermissionsIds();

        $this->edit = true;
        $this->delete = false;
        $this->showEditCreateModal = true;
    }

    public function delete(Role $role): void
    {
        $this->role = $role;

        $this->edit = false;
        $this->delete = true;
        $this->showConfirmationModal = true;
    }

    public function confirmSave(): void
    {
        $this->validate();
        $this->showConfirmationModal = true;
    }

    public function save(): void
    {
        $this->role->syncPermissions($this->permissions);
        $this->role->save();

        $this->showConfirmationModal = false;
        $this->showEditCreateModal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' => $this->edit ? 'Rol actualizado exitosamente' : 'Rol creado exitosamente',
        ]);
    }

    public function destroy(): void
    {
        $this->role->delete();
        $this->showConfirmationModal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' => 'Rol eliminado exitosamente',
        ]);
    }

    private function getPermissionsIds(): array
    {
        return $this->role->getAllPermissions()->pluck('id')->toArray();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.admin.roles.index', [
            'roles' => Role::query()
                ->where('name', 'like', "%$this->search%")
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
