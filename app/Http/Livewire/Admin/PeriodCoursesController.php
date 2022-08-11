<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSorting;
use App\Models\Period;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class PeriodCoursesController extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithSorting;

    public Period $periods;
    public $per_page = 5;
    public $search = '';

    public $periodo_id;

    public $filters_1 = '';
    public $filters_2 = '';
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'per_page' => ['except' => 1, 'as' => 'p'],
    ];

    public bool $edit = false;
    public bool $create = false;
    public bool $show_edit_create_modal = false;
    public bool $confirming_period_deletion = false;
    public bool $confirming_save_period = false;
    public bool $confirming_period_active =false;
    public bool $confirming_period_Inactive =false;

    public $f_i;
    public $f_f;
    public $arreglo_id=[];
    public $arreglo_estatus=[];

    public bool $estado_x = false;

    public function rules(){
        if ($this->edit) {
            return [
                'periods.clave' => ['required',Rule::unique('periods', 'clave')->ignore($this->periods)],
                'periods.fecha_inicio' => ['required', 'date'],
                'periods.fecha_fin' => ['required', 'date'],
            ];
        }
        return [
            'periods.clave' => ['required', 'unique:periods'],
            'periods.fecha_inicio' => ['required', 'date', 'unique:periods'],
            'periods.fecha_fin' => ['required', 'date', 'unique:periods'],
        ];
    }

    public function mount(){
        $this->blank_user();
    }
    public function blank_user(){
        $this->periods = Period::make();
    }

    public function updated($x){
        $this->validateOnly($x);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function open_modal(){
        $this->show_edit_create_modal = true;
    }
    public function close_modal(){
        $this->show_edit_create_modal = false;
    }

    public function resetFilters(){
        $this->reset('search');
        $this->reset('filters_1');
        $this->reset('filters_2');
    }
    /**
     * @throws AuthorizationException
     */
    public function create(){
        $this->blank_user();
        $this->open_modal();
        $this->confirming_period_deletion = false;
        $this->confirming_save_period = false;
        $this->edit = false;
        $this->create = true;
    }
    /**
        * @throws AuthorizationException
     */
    public function edit($id){
        $this->authorize('periods.edit');
        $this->periods = Period::findOrFail($id);
        $this->edit = true;
        $this->create = false;
        $this->open_modal();
    }
    public function update_period()
    {
        $this->validate();
        $this->confirming_save_period = true;
    }

    public function save(){
        $this->periods->estado = 0;
        $this->periods->ofertado = 0;
        $this->periods->fecha_limite_para_calificar = $this->periods->fecha_fin;
        $this->periods->save();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->show_edit_create_modal = false;
        $this->confirming_period_deletion = false;
        $this->confirming_save_period = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Período actualizado exitosamente' : 'Período creado exitosamente',
        ]);
        $this->edit = false;
        $this->create = false;
    }
    /**
     * @throws AuthorizationException
     */
    public function delete_period($id)
    {
        $this->authorize('periods.delete');
        $this->periods = Period::findOrFail($id);
        $this->confirming_period_deletion = true;
    }

    public function delete()
    {
        $this->periods->delete();
        $this->confirming_period_deletion = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Período eliminado exitosamente',
        ]);
    }

    public function periodo_activar($id){
        $this->periodo_id = $id;
        $this->confirming_period_active=true;
    }
    public function periodo_desactivar($id){
        $this->periodo_id = $id;
        $this->confirming_period_Inactive=true;
    }

    public function desactivar_todos(){
        DB::table('periods')
            ->update(['estado' => 0]);
    }

    public function activar(){
        $this->desactivar_todos();
        DB::table('periods')
            ->where('periods.id','=',$this->periodo_id)
            ->update(['estado' => 1]);
        $this->confirming_period_active=false;
    }

    public function desactivar(){
        DB::table('periods')
            ->where('periods.id','=',$this->periodo_id)
            ->update(['estado' => 0]);
        $this->confirming_period_Inactive=false;
    }

    public function obtener_fechas_activas(){
        $fecha_i_1=Period::select('periods.fecha_inicio')
                               ->where('periods.estado','=',1)
                               ->first();

        $fecha_f_1=Period::select('periods.fecha_fin')
                                ->where('periods.estado','=',1)
                               ->first();
        $this->f_i= $fecha_i_1->fecha_inicio;
        $this->f_f= $fecha_f_1->fecha_fin;
    }

    public function render()
    {
        return view('livewire.admin.periodCourses.index', [
            'datos' => Period::query()
                ->when($this->filters_1, function ($query, $b) {
                    $query->where('periods.fecha_inicio', '>=', "%$b%");
                })
                ->when($this->filters_2, function ($query, $b) {
                    $query->where('periods.fecha_fin', '<=', "%$b%");
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->per_page),
        ]);
    }

    public function confirmar(){
        if ($this->estado_x) {
            $this->estado_x = false;
        }else {
            $this->estado_x = true;
        }
    }
}
