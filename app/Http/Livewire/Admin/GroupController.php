<?php

namespace App\Http\Livewire\Admin;

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSorting;
use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GroupController extends Component
{
    use WithPagination;
    use WithSorting;
    use AuthorizesRequests;

    public $groups;

    public $edit = false;
    public $create = false;
    public $isOpen = false;
    public $confirmingGroupDeletion = false;
    public $confirmingSaveGroup = false;

    public $perPage = '8';
    public $search = '';

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public function rules(): array{
        return  ($this->edit) ?
        ['groups.nombre' => ['required', 'regex:/^[\pL\pM]+$/u', 'max:8',Rule::unique('groups', 'nombre')->ignore($this->groups)]]
        :
        ['groups.nombre' => ['required', 'regex:/^[\pL\pM]+$/u', 'max:8', 'unique:groups']];
    }

    public function mount(){
        $this->blankGroup();
    }

    public function blankGroup(){
        $this->groups = Group::make();
    }
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetFilters(){
        $this->reset('search');
    }
    /**
     * @throws AuthorizationException
     */
    public function create(){
        $this->resetErrorBag();
        $this->blankGroup();
        $this->openModal();
        $this->edit = false;
        $this->confirmingSaveGroup = false;
        $this->create = true;
    }

    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
    }

    public function save(){
        $this->validate();
        $this->groups->save();
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
        $this->confirmingSaveGroup = false;
        $this->confirmingGroupDeletion = false;
    }

    public function updateGroup(){
        $this->validate();
        $this->confirmingSaveGroup = true;
    }

    /**
        * @throws AuthorizationException
     */
    public function edit($id){
        $this->authorize('groups.edit');
        $this->resetErrorBag();
        $this->groups = Group::findOrFail($id);
        $this->edit = true;
        $this->create = false;
        $this->openModal();
        $this->confirmingSaveGroup = false;
        $this->validate();
    }
    /**
     * @throws AuthorizationException
     */
    public function deleteGroup($id){
        $this->authorize('groups.delete');
        $this->groups = Group::findOrFail($id);
        $this->confirmingGroupDeletion = true;
    }
    public function delete(){
        $this->groups->delete();
        $this->closeModal();
        $this->confirmingSaveGroup = false;
        $this->confirmingGroupDeletion = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Grupo eliminado exitosamente',
        ]);
    }

    public function render(){
        return view('livewire.admin.groups.index', [
            'datos' => Group::where('nombre', 'like', '%'.$this->search.'%')
                     ->orderBy($this->sortField, $this->sortDirection)
                     ->paginate($this->perPage),
        ]);
    }
}
