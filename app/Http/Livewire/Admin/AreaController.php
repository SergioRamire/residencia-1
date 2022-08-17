<?php

namespace App\Http\Livewire\Admin;

use App\Models\Area;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AreaController extends Component
{
    use WithPagination;
    use WithSorting;
    use AuthorizesRequests;

    public Area $areas;
    public $edit = false;
    public $create = false;

    public $showEditCreateModal = false;
    public $confirmingAreaDeletion = false;
    public $confirmingSaveArea = false;

    //variables de activar area
    public bool $confirming_area_active =false;
    public bool $confirming_area_Inactive =false;
    public $area_id;

    public bool $permiso_eliminicacion = false;

    public $perPage = '8';
    public $search = '';
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public function rules(): array{
        if ($this->edit) {
            return [
                'areas.nombre' => ['required', 'regex:/^[\pL\pM\s]+$/u',Rule::unique('areas', 'nombre')->ignore($this->areas)],
                'areas.jefe_area' => ['required', 'regex:/^[\pL\pM\s]+$/u'],
                'areas.extension' => ['required', 'numeric'],
                'areas.clave' => ['required', 'alpha_num',Rule::unique('areas', 'clave')->ignore($this->areas)],
                'areas.telefono' => ['required', 'numeric'],
        ];}
        return [
            'areas.nombre' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'unique:areas'],
            'areas.jefe_area' => ['required', 'regex:/^[\pL\pM\s]+$/u'],
            'areas.extension' => ['required', 'numeric'],
            'areas.clave' => ['required', 'alpha_num', 'unique:areas'],
            'areas.telefono' => ['required', 'numeric'],
        ];
    }

    public function mount(){
        $this->blank_area();
    }
    public function blank_area(){
        $this->areas = Area::make();
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
        $this->blank_area();
        $this->showEditCreateModal = true;
        $this->edit = false;
        $this->create = true;
    }

    public function save(){
        $this->validate();
        $this->areas->save();
        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Área actualizada exitosamente' : 'Área creada exitosamente',
        ]);

        $this->edit = false;
        $this->create = false;
        $this->confirmingSaveArea = false;
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();
        $this->showEditCreateModal = false;
    }

    public function update_area(){
        $this->validate();
        $this->confirmingSaveArea = true;
    }

    /**
        * @throws AuthorizationException
     */
    public function edit($id){
         /* Reinicia los errores */
        $this->authorize('areas.edit');
         $this->resetErrorBag();
         $this->resetValidation();

        $this->areas = Area::findOrFail($id);
        $this->edit = true;
        $this->create = false;
        $this->showEditCreateModal = true;
    }

    public function permiso_para_eliminar($id){
        $consulta = Area::join('users','users.area_id','=','areas.id')
                          ->where('areas.id','=',$id)
                          ->first();
        ($consulta != null) ? $this->permiso_eliminicacion = false : $this->permiso_eliminicacion = true;
    }
    /**
     * @throws AuthorizationException
     */
    public function delete_area($id){
        $this->authorize('areas.delete');
        $this->areas = Area::findOrFail($id);
        $this->confirmingAreaDeletion = true;
    }

    public function delete(){
        $this->areas->delete();
        $this->confirmingAreaDeletion = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Área eliminada exitosamente',
        ]);
    }

    public function area_activar($id){
        $this->area_id = $id;
        $this->confirming_area_active=true;
    }

    public function area_desactivar($id){
        $this->area_id = $id;
        $this->confirming_area_Inactive=true;
    }

    public function activar(){
        DB::table('areas')
            ->where('areas.id','=',$this->area_id)
            ->update(['estatus' => 1]);
        $this->confirming_area_active=false;
    }

    public function desactivar(){
        DB::table('areas')
            ->where('areas.id','=',$this->area_id)
            ->update(['estatus' => 0]);
        $this->confirming_area_Inactive=false;
    }

    public function render(){
        return view('livewire.admin.areas.index', [
            'datosareas' => Area::where('nombre', 'like', '%'.$this->search.'%')
                            ->orWhere('jefe_area', 'like', '%'.$this->search.'%')
                            ->orWhere('clave', 'like', '%'.$this->search.'%')
                            ->orWhere('telefono', 'like', '%'.$this->search.'%')
                            ->orWhere('extension', 'like', '%'.$this->search.'%')
                            ->orderBy($this->sortField, $this->sortDirection)
                            ->paginate($this->perPage),
        ]);
    }
}
