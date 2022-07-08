<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\Period;
use App\Models\CourseDetail;
use App\Http\Traits\WithSorting;
use App\Http\Livewire\Admin\DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

use App\Exports\ListExport;
use Maatwebsite\Excel\Facades\Excel;

class GradeController extends Component
{
    use WithPagination;
    use WithSorting;

    // public Inscription $grade;
    public $perPage = '8';
    public $search = '';
    public $calificacion;
    public $asistencias_minimas;
    public $participante;
    public $grad;
    public $curso;
    public $monthName;

    //
    public $user;
    public $id_course;
    public $id_period;
    public $id_group;

    public $cuenta =0;
    //

    public $course_details_id;
    public $grupo;
    public bool $isOpen = false;
    public bool $grade_id;
    public bool $confirmingSaveGrade = false;
    public bool $disponible=true;

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetFilters(){
        $this->reset('search');
    }

    private function validateInputs(){
        $this->validate([
            'calificacion' => ['required', 'numeric', 'min:1', 'max:100'],
        ]);
    }

    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
    }

    public function store(){
        $this->validateInputs();
        $user = User::find($this->grade_id);
        $user->courseDetails()->syncWithPivotValues($this->course_details_id, ['calificacion' => $this->calificacion, 'asistencias_minimas'=>$this->asistencias_minimas]);
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'pencil',
            'message' => 'Calificación actualizada exitosamente',
        ]);
        $this->confirmingSaveGrade = false;
        $this->closeModal();
    }

    public function edit($id){
        $grade = User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
                ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
                ->join('courses', 'courses.id', '=', 'course_details.course_id')
                ->join('groups', 'groups.id', '=', 'course_details.group_id')
                ->where('users.id', '=', $id)
                ->where('course_details.id', '=', $this->id_course)
                ->select('users.id', 'course_details.id as course_details_id', DB::raw("concat(users.name,' ',users.apellido_paterno)as nombre"),
                'courses.nombre as curso', 'groups.nombre as grupo', 'inscriptions.asistencias_minimas','inscriptions.calificacion')
                ->first();
        $this->grade_id = $id;
        $this->course_details_id = $grade->course_details_id;
        $this->participante = $grade->nombre;
        $this->curso = $grade->curso;
        $this->grupo = $grade->grupo;
        $this->calificacion = $grade->calificacion;
        $this->asistencias_minimas=$grade->asistencias_minimas;
        $this->validateInputs();
        $this->openModal();
    }

    public function updateGrade(){
        $this->validateInputs();
        $this->confirmingSaveGrade = true;
    }

    public function obtenerUsuario(){
        $this->user = User::find(auth()->user()->id);
    }

    public function consultarcursos(){
        // $user = User::find(auth()->user()->id);
        $fecha_actual = date("Y-m-d");
        // $this->id_user=$user->id;
        $this->obtenerUsuario();
        return CourseDetail::join('inscriptions','inscriptions.course_detail_id','course_details.id')
                    ->join('users','users.id','inscriptions.user_id')
                    ->join('courses','courses.id','course_details.course_id')
                    ->join('periods','periods.id','course_details.period_id')
                    ->where('users.id','=',$this->user->id)
                    ->where('inscriptions.estatus_participante','=','Instructor')
                    ->where('periods.estado','=',1)
                    ->select('course_details.id','courses.nombre')
                    ->get();
    }

    public function consultargrupos(){
        $fecha_actual = date("Y-m-d");
        $this->obtenerUsuario();
        return  CourseDetail::join('groups','groups.id','course_details.group_id')
                    ->where('course_details.id','=',$this->id_course)
                    ->select('groups.id','groups.nombre')
                    ->get();
    }

    public function consultaperiodos(){
        $fecha_actual = date("Y-m-d");
        return Period::where('periods.fecha_inicio','<',$fecha_actual);
    }

    public function cuentaCursos(){
        $cursosTotales=$this->consultarcursos();
        $this->cuenta=count($cursosTotales);
    }

    public function mostrarcursos(){
        return User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->where('inscriptions.estatus_participante', '=','Participante')
            ->where('course_details.id', '=',$this->id_course)
            ->select('users.id','users.name', 'users.apellido_paterno', 'users.apellido_materno'
                    ,'inscriptions.calificacion','courses.nombre as curso','groups.nombre as grupo',
                    'periods.fecha_inicio', 'periods.fecha_fin')
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->Where(DB::raw("concat(users.name,' ',users.apellido_paterno,
                      ' ', users.apellido_materno)"), 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function render(){
        $this->cuentaCursos();
        $cur=$this->consultarcursos();
        if($this->cuenta==1){
            $this->curso=$cur[0]->nombre;
            $this->id_course=$cur[0]->id;
        }
        return view('livewire.admin.grades.index', [
            'grades' => User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->where('inscriptions.estatus_participante', '=','Participante')
            ->where('course_details.id', '=',$this->id_course)
            ->select('users.id','users.name', 'users.apellido_paterno', 'users.apellido_materno'
                    ,'inscriptions.calificacion','inscriptions.asistencias_minimas','courses.nombre as curso','groups.nombre as grupo',
                    'periods.fecha_inicio', 'periods.fecha_fin')
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->Where(DB::raw("concat(users.name,' ',users.apellido_paterno,
                      ' ', users.apellido_materno)"), 'like', '%'.$this->search.'%')
                      ->orWhere('groups.nombre', 'like', '%'.$this->search.'%')
                      ->orWhere('inscriptions.calificacion', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
                        ->paginate($this->perPage),
            'courses' => $this->consultarcursos(),
            'groups' => $this->consultargrupos()
        ]);
    }

    public function descarga(){
        $data=$this->participants();

        return Excel::download(new ListExport($data), 'Lista_Asistencia.xlsx');
    }

    public function evaluar_si_existen_grupos(){
        $grupos = User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id');

    }

    public function participants(){
        return User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
        ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
        ->join('courses', 'courses.i d', '=', 'course_details.course_id')
        ->join('groups', 'groups.id', '=', 'course_details.group_id')
        ->join('areas', 'areas.id', '=', 'users.area_id')
        ->join('periods', 'periods.id', '=', 'course_details.period_id')
        ->where('inscriptions.estatus_participante', '=','Participante')
        ->where('course_details.id', '=',$this->id_course)
        ->select('inscriptions.id',DB::raw("concat(users.name,' ',users.apellido_paterno,
        ' ', users.apellido_materno) as nombre"),'users.name as name','users.apellido_paterno as app','users.apellido_materno as apm','users.rfc as rfc','users.curp as curp','users.sexo as sex','courses.clave as clave','courses.duracion as duracion','courses.nombre as curso','groups.nombre as grupo','course_details.modalidad as modalidad',
        'areas.nombre as area', 'periods.fecha_inicio as fi', 'periods.fecha_fin as ff','course_details.hora_inicio as hi','course_details.hora_fin as hf')->get();
    }

}
