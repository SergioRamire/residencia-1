<?php

namespace App\Http\Livewire\Admin;

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSorting;
use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GroupController extends Component
{
    use WithPagination;
    use WithSorting;
    use AuthorizesRequests;
    public $groups;

    public $edit = false;
    public $create = false;
    public $is_open = false;
    public $confirming_group_deletion = false;
    public $confirming_save_group = false;
    public bool $confirming_group_active =false;
    public bool $confirming_group_Inactive =false;
    public $grupo;
    public bool $permiso_eliminacion =false;
    public bool $showConfirmationModal = false;

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
        $this->blank_group();
    }

    public function blank_group(){
        $this->groups = Group::make();
    }
    public function updated($x){
        $this->validateOnly($x);
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
        $this->authorize('group.create');
        $this->resetErrorBag();
        $this->blank_group();
        $this->open_modal();
        $this->edit = false;
        $this->confirming_save_group = false;
        $this->create = true;
    }

    public function open_modal(){
        $this->is_open = true;
    }

    public function close_modal(){
        $this->is_open = false;
    }

    public function save(){
        $this->validate();
        $this->groups->estatus = 1;
        $this->groups->save();
        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Grupo actualizado exitosamente' : 'Grupo creado exitosamente',
        ]);
        $this->edit = false;
        $this->create = false;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->close_modal();
        $this->confirming_save_group = false;
        $this->confirming_group_deletion = false;
    }

    public function update_group(){
        $this->validate();
        $this->confirming_save_group = true;
    }

    /**
        * @throws AuthorizationException
     */
    public function edit($id){
        $this->authorize('group.edit');
        $this->resetErrorBag();
        $this->groups = Group::findOrFail($id);
        $this->edit = true;
        $this->create = false;
        $this->open_modal();
        $this->confirming_save_group = false;
        $this->validate();
    }
    /**
     * @throws AuthorizationException
     */
    public function delete_group($id){
        $this->authorize('group.delete');
        $this->groups = Group::findOrFail($id);
        $this->confirming_group_deletion = true;
    }
    public function delete(){
        $this->groups->delete();
        $this->close_modal();
        $this->confirming_save_group = false;
        $this->confirming_group_deletion = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Grupo eliminado exitosamente',
        ]);
    }

    public function permiso_para_eliminar($id){
        $consulta = Group::join('course_details','course_details.group_id','=','groups.id')
                          ->where('groups.id','=',$id)
                          ->first();
        ($consulta != null) ? $this->permiso_eliminacion = false : $this->permiso_eliminacion = true;
    }

    public function group_habilitar($id){
        $this->grupo=Group::find($id);
        $this->confirming_group_active=true;
        $this->showConfirmationModal = true;
    }

    public function group_inhabilitar($id){
        $this->grupo=Group::find($id);
        $this->confirming_group_Inactive=true;
        $this->showConfirmationModal = true;
    }

    public function habilitar(){
        DB::table('groups')
            ->where('groups.id','=',$this->grupo->id)
            ->update(['estatus' => 1]);
        $this->confirming_group_active=false;
        $this->showConfirmationModal = false;
    }

    public function inhabilitar(){
        DB::table('groups')
            ->where('groups.id','=',$this->grupo->id)
            ->update(['estatus' => 0]);
        $this->confirming_group_Inactive=false;
        $this->showConfirmationModal = false;
    }


    public function render(){
        return view('livewire.admin.groups.index', [
            'datos' => Group::where('nombre', 'like', '%'.$this->search.'%')
                     ->orderBy($this->sortField, $this->sortDirection)
                     ->paginate($this->perPage),
        ]);
    }
}
