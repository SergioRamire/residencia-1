<?php

namespace App\Http\Livewire\Admin;

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSorting;
use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class GroupController extends Component
{
    use WithPagination;
    use WithSorting;

    public $group;
    public $perPage = '5';
    public $search = '';
    public $group_id;
    public $nombre;

    public $edit = false;
    public $create = false;

    public $isOpen = false;
    public $confirmingGroupDeletion = false;
    public $confirmingSaveGroup = false;

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public function rules(): array
    {
        if ($this->edit) {
            return [
                'nombre' => ['required', 'regex:/^[\pL\pM]+$/u', 'max:8'],
            ];
        }

        return [
            'nombre' => ['required', 'regex:/^[\pL\pM]+$/u', 'max:8', 'unique:groups'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('search');
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->resetInputFields();
        $this->openModal();
        $this->edit = false;
        $this->confirmingSaveGroup = false;
        $this->create = true;
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->group_id = '';
        $this->nombre = '';
    }

    public function store()
    {
        $this->validate();

        Group::updateOrCreate(['id' => $this->group_id], [
            'nombre' => $this->nombre,
        ]);

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Grupo actualizado exitosamente' : 'Grupo creado exitosamente',
        ]);

        $this->edit = false;
        $this->create = false;

        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->closeModal();
        $this->resetInputFields();
    }

    public function updateGroup()
    {
        $this->validate();
        $this->confirmingSaveGroup = true;
    }

    public function edit($id)
    {
        $this->resetErrorBag();
        $group = Group::findOrFail($id);
        $this->group_id = $id;
        $this->nombre = $group->nombre;
        $this->edit = true;
        $this->create = false;
        $this->openModal();
        $this->confirmingSaveGroup = false;
        $this->validate();
    }

    public function deleteGroup($id)
    {
        $this->group = Group::findOrFail($id);
        $this->confirmingGroupDeletion = true;
    }

    public function delete()
    {
        $this->group->delete();

        $this->confirmingGroupDeletion = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Grupo eliminado exitosamente',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.groups.index', [
            'groups' => Group::where('nombre', 'like', '%'.$this->search.'%')
                     ->orderBy($this->sortField, $this->sortDirection)
                     ->paginate($this->perPage),
        ]);
    }
}
