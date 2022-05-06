<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleController extends Component
{
    use WithPagination;

    public Role $role;
    public int $perPage = 5;
    public string $search = '';
    public string $sortField = 'id';
    public string $sortDirection = 'asc';

    public bool $showEditCreateModal = false;
    public bool $showViewModal = false;
    public bool $showConfirmationModal = false;
    public $edit;
    public $delete;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDirection',
    ];

    protected $rules = [
        'role.name' => ['required'],
    ];

    public function mount()
    {
        $this->blankRole();
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

    public function blankRole()
    {
        $this->role = Role::make();
    }

    public function create()
    {
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->blankRole();

        $this->edit = false;
        $this->delete = false;
        $this->showEditCreateModal = true;
    }

    public function edit(Role $role)
    {
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->role = $role;

        $this->edit = true;
        $this->delete = false;
        $this->showEditCreateModal = true;
    }

    public function delete(Role $role)
    {
        $this->role = $role;

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
        $this->role->save();

        $this->showConfirmationModal = false;
        $this->showEditCreateModal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' => $this->edit ? 'Rol actualizado exitosamente' : 'Rol creado exitosamente',
        ]);
    }

    public function destroy()
    {
        $this->role->delete();
        $this->showConfirmationModal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' => 'Rol eliminado exitosamente',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.roles.index', [
            'roles' => Role::query()
                ->where('name', 'like', "%$this->search%")
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
