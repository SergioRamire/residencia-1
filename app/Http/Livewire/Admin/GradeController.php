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
    public $id_user_participant;
    public $id_course;
    public $id_period;
    public $id_group;

    public $cuenta =0;
    public $cuenta_periodos;

    public $course_details_id;
    public $grupo;
    public bool $is_open = false;
    public bool $confirming_save_grade = false;
    public bool $disponible=false;
    public $aux_fecha;


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

    public function open_modal(){
        $this->is_open = true;
    }

    public function close_modal(){
        $this->is_open = false;
    }

    public function store(){
        $this->validateInputs();
        $this->obtener_usuario();
        $user_parti= User::find($this->id_user_participant);
        $user_parti->courseDetails()->syncWithPivotValues($this->course_details_id, ['calificacion' => $this->calificacion, 'asistencias_minimas'=>$this->asistencias_minimas]);
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'pencil',
            'message' => 'Calificación actualizada exitosamente',
        ]);
        $this->confirming_save_grade = false;
        $this->close_modal();
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
        $this->id_user_participant= $grade->id;
        $this->course_details_id = $grade->course_details_id;
        $this->participante = $grade->nombre;
        $this->curso = $grade->curso;
        $this->grupo = $grade->grupo;
        $this->calificacion = $grade->calificacion;
        $this->asistencias_minimas=$grade->asistencias_minimas;
        $this->open_modal();
        $this->validateInputs();
    }

    public function update_grade(){
        $this->validateInputs();
        $this->confirming_save_grade = true;
    }

    public function obtener_usuario(){
        $this->user = User::find(auth()->user()->id);
    }

    public function consultar_cursos(){
        $this->obtener_usuario();
        if($this->cuenta_periodos>0){
            foreach($this->consultar_periodos() as $periodo){
                return CourseDetail::join('inscriptions','inscriptions.course_detail_id','course_details.id')
                    ->join('users','users.id','inscriptions.user_id')
                    ->join('courses','courses.id','course_details.course_id')
                    ->join('periods','periods.id','course_details.period_id')
                    ->where('users.id','=',$this->user->id)
                    ->where('inscriptions.estatus_participante','=','Instructor')
                    ->where('periods.id','=',$periodo->id)
                    ->select('course_details.id','courses.nombre')
                    ->get();
            }
        }

    }

    public function consultar_grupos(){
        $fecha_actual = date("Y-m-d");
        $this->obtener_usuario();
        return  CourseDetail::join('groups','groups.id','course_details.group_id')
                    ->where('course_details.id','=',$this->id_course)
                    ->select('groups.id','groups.nombre')
                    ->get();
    }


    public function cuenta_cursos(){
        $cursosTotales=$this->consultar_cursos();
        if($cursosTotales != null)
            $this->cuenta=count($cursosTotales);
        $this->cuenta=0;
        // $this->cuenta=count($cursosTotales);
        // dd($cursosTotales);
        // $this->cuenta=0;
    }

    public function mostrar_cursos(){
        return User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->where('inscriptions.estatus_participante', '=','Participante')
            ->where('course_details.id', '=',$this->id_course)
            ->select('users.id','users.name', 'users.apellido_paterno', 'users.apellido_materno'
                    ,'inscriptions.calificacion','inscriptions.asistencias_minimas as asistencias_min','courses.nombre as curso','groups.nombre as grupo',
                    'periods.fecha_inicio', 'periods.fecha_fin')
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->Where(DB::raw("concat(users.name,' ',users.apellido_paterno,
                      ' ', users.apellido_materno)"), 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function validar_limite(){
        ($this->cuenta_periodos != null) ? $this->disponible=true : $this->disponible=false ;
    }

    public function consultar_periodos(){
        $fecha_actual = date('Y-m-d', strtotime(date('Y-m-d')));
        $consulta = Period::where('periods.fecha_inicio','<=',$fecha_actual)
                            ->where('periods.fecha_limite_para_calificar','>=',$fecha_actual)
                            ->select('periods.id')
                            ->get();
        $this->cuenta_periodos = count($consulta);
        // dd($this->cuenta_periodos);
        $this->validar_limite();
        return $consulta;


    }

    public function render(){
        $this->consultar_periodos();
        $this->cuenta_cursos();
        $cur=$this->consultar_cursos();
        if($this->cuenta==1){
            $this->curso=$cur[0]->nombre;
            $this->id_course=$cur[0]->id;
        }
        return view('livewire.admin.grades.index', [
            'grades' => $this->mostrar_cursos()->paginate($this->perPage),
            'courses' => $this->consultar_cursos(),
            'groups' => $this->consultar_grupos()
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
        ->join('courses', 'courses.id', '=', 'course_details.course_id')
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
