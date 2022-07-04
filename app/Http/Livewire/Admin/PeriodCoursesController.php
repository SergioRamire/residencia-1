<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSorting;
use App\Models\Period;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Models\User;

class PeriodCoursesController extends Component
{
    use WithPagination;
    use WithSorting;

    public Period $period;
    public $perPage = 5;
    public $search = '';
    public $periodo_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $clave;
    public $numero = 1;
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

    public function rules(): array
    {
        if ($this->edit) {
            return [
                'clave' => ['required', 'unique:periods'],
                'fecha_inicio' => ['required', 'date'],
                'fecha_fin' => ['required', 'date'],
            ];
        }

        return [
            'clave' => ['required', 'unique:periods'],
            'fecha_inicio' => ['required', 'date', 'unique:periods'],
            'fecha_fin' => ['required', 'date', 'unique:periods'],
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
        $this->reset('filters');
        $this->reset('filters2');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
        $this->confirmingPeriodDeletion = false;
        $this->confirmingSavePeriod = false;
        $this->edit = false;
        $this->create = true;
    }

    public function openModal()
    {
        $this->showEditCreateModal = true;
    }

    public function closeModal()
    {
        $this->showEditCreateModal = false;
    }

    private function resetInputFields()
    {
        $this->periodo_id = '';
        $this->clave = '';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
    }

    public function updatePeriod()
    {
        $this->validate();
        $this->confirmingSavePeriod = true;
    }

    public function edit($id)
    {
        $period = Period::findOrFail($id);
        $this->periodo_id = $id;
        $this->clave = $period->clave;
        $this->fecha_inicio = $period->fecha_inicio;
        $this->fecha_fin = $period->fecha_fin;
        $this->edit = true;
        $this->create = false;
        $this->openModal();
    }

    public function store()
    {
        // $this->validateInputs();

        Period::updateOrCreate(['id' => $this->periodo_id], [
            'clave' => $this->clave,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'estado' => 0,
        ]);

        $this->edit = false;
        $this->create = false;
        $this->confirmingSaveArea = false;
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->showEditCreateModal = false;
        $this->confirmingPeriodDeletion = false;
        $this->confirmingSavePeriod = false;
        $this->resetInputFields();

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Periodo actualizado exitosamente' : 'Periodo creado exitosamente',
        ]);
    }

    public function deletePeriod($id, $fi, $ff)
    {
        $this->period = Period::findOrFail($id);
        $this->fecha_inicio = $fi;
        $this->fecha_fin = $ff;
        $this->confirmingPeriodDeletion = true;
    }

    public function delete()
    {
        $this->period->delete();
        $this->confirmingPeriodDeletion = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Periodo eliminado exitosamente',
        ]);
        $this->resetInputFields();
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
            'periods' => Period::query()
                ->when($this->filters, function ($query, $b) {
                    return $query->where(function ($q) {
                        $q->where('fecha_inicio', '>=', $this->filters);
                    });
                })
                ->when($this->filters2, function ($query, $b) {
                    return $query->where(function ($q) {
                        $q->where('fecha_fin', '<=', $this->filters2);
                    });
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
