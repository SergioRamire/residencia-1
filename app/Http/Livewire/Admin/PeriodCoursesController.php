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
    public $perPage = 5;
    public $search = '';

    public $periodo_id;

    public $filters = '';
    public $filters2 = '';
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public bool $edit = false;
    public bool $create = false;
    public bool $showEditCreateModal = false;
    public bool $confirmingPeriodDeletion = false;
    public bool $confirmingSavePeriod = false;
    public bool $confirmingPeriodActive =false;
    public bool $confirmingPeriodInactive =false;

    public $f_i;
    public $f_f;
    public $arreglo_id=[];
    public $arreglo_estatus=[];

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
        $this->blankUser();
    }
    public function blankUser(){
        $this->periods = Period::make();
    }

    public function updated($x){
        $this->validateOnly($x);
    }
    public function updatingSearch(){
        $this->resetPage();
    }

    public function openModal(){
        $this->showEditCreateModal = true;
    }
    public function closeModal(){
        $this->showEditCreateModal = false;
    }

    public function resetFilters(){
        $this->reset('search');
        $this->reset('filters');
        $this->reset('filters2');
    }
    /**
     * @throws AuthorizationException
     */
    public function create(){
        $this->blankUser();
        $this->openModal();
        $this->confirmingPeriodDeletion = false;
        $this->confirmingSavePeriod = false;
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
        $this->openModal();
    }
    public function updatePeriod()
    {
        $this->validate();
        $this->confirmingSavePeriod = true;
    }

    public function save(){
        $this->periods->estado = 0;
        $this->periods->ofertado = 0;
        $this->periods->fecha_limite_para_calificar = $this->periods->fecha_fin;
        $this->periods->save();

        $this->edit = false;
        $this->create = false;
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->showEditCreateModal = false;
        $this->confirmingPeriodDeletion = false;
        $this->confirmingSavePeriod = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Periodo actualizado exitosamente' : 'Periodo creado exitosamente',
        ]);
    }
    /**
     * @throws AuthorizationException
     */
    public function deletePeriod($id)
    {
        $this->authorize('periods.delete');
        $this->periods = Period::findOrFail($id);
        $this->confirmingPeriodDeletion = true;
    }

    public function delete()
    {
        $this->periods->delete();
        $this->confirmingPeriodDeletion = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Periodo eliminado exitosamente',
        ]);
    }

    public function periodoActivar($id){
        $period = Period::findOrFail($id);
        $this->periodo_id = $id;
        $this->confirmingPeriodActive=true;
    }
    public function periodoDesactivar($id){
        $period = Period::findOrFail($id);
        $this->periodo_id = $id;
        $this->confirmingPeriodInactive=true;
    }

    public function desactivarTodos(){
        DB::table('periods')
            ->update(['estado' => 0]);
    }

    public function activar(){
        $this->desactivarTodos();
        DB::table('periods')
            ->where('periods.id','=',$this->periodo_id)
            ->update(['estado' => 1]);
        // Period::updateOrCreate(['id' => $this->periodo_id], [
        //     'estado' => 1,
        // ]);
        $this->confirmingPeriodActive=false;
        // $this->cambiodeRol();
    }
    public function desactivar(){
        DB::table('periods')
            ->where('periods.id','=',$this->periodo_id)
            ->update(['estado' => 0]);
        // Period::updateOrCreate(['id' => $this->periodo_id], [
        //     'estado' => 0,
        // ]);
        $this->confirmingPeriodInactive=false;
    }

    public function obtenerFechasActivas(){
        $fecha_i_1=Period::select('periods.fecha_inicio')
                               ->where('periods.estado','=',1)
                               ->first();

        $fecha_f_1=Period::select('periods.fecha_fin')
                                ->where('periods.estado','=',1)
                               ->first();
        $this->f_i= $fecha_i_1->fecha_inicio;
        $this->f_f= $fecha_f_1->fecha_fin;
    }

    public function obteneUsuariosPeriodoActivo(){
        return User::join('inscriptions','inscriptions.user_id','users.id')
        ->join('course_details','course_details.id','inscriptions.course_detail_id')
        ->join('periods','periods.id','course_details.period_id')
        ->select('inscriptions.user_id','inscriptions.estatus_participante')
        ->where('periods.estado','=',1)
        ->get();
    }
    public function cambiodeRol(){
        $this-> obtenerFechasActivas();
        $fecha_actual = date("Y-m-d");
        $consulta=$this->obteneUsuariosPeriodoActivo();
        foreach($consulta as $co){
            array_push($this->arreglo_id,$co->user_id);
        }

        foreach($consulta as $co){
            array_push($this->arreglo_estatus,$co->estatus_participante);
        }

        if(($fecha_actual >= $this->f_i) && ($fecha_actual <= $this->f_f)) {

            for($i=0;$i<count($consulta);$i++){
                $user = User::findOrFail($this->arreglo_id[$i]);
                $user->syncRoles($this->arreglo_estatus[$i]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.periodCourses.index', [
            'datos' => Period::query()
                ->when($this->filters, function ($query, $b) {
                    $query->where('periods.fecha_inicio', '>=', "%$b%");
                })
                ->when($this->filters2, function ($query, $b) {
                    $query->where('periods.fecha_fin', '<=', "%$b%");
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }

    public bool $estadox = false;

    public function confirmar(){
        if ($this->estadox) {
            $this->estadox = false;
        }else {
            $this->estadox = true;
        }
    }
}
