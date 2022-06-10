<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Period;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class InscriptionsController extends Component
{
    use WithPagination;
    public User $user;
    public int $perPage = 5;
    public int $perPage2 = 3;
    public $arreglo = [];
    public $arreglo1 = [];
    public $unionarreglos = [];
    public $keyCache = 'horario'; /* .auth()->user()->id; */
    public int $countabla1 = 1;
    public int $countabla2 = 1;
    public $fecha_inicio_periodo1;
    public $fecha_fin_periodo1;
    public $fecha_inicio_periodo2;
    public $fecha_fin_periodo2;

    public bool $btnContinuar = false;
    public bool $showHorario = false;
    public bool $confirmingSaveInscription = false;
    protected $queryString = [
        'perPage' => ['except' => 5, 'as' => 'p'],
        'perPage2' => ['except' => 3, 'as' => 'p2'],
    ];

    public function openShowHorario(){

        $this->showHorario = true;
    }
    public function closeShowHorario(){
        $this->showHorario = false;

    }
    public function openbtnContinuar(){
        $this->btnContinuar = true;
    }
    public function closeShowOneModal(){
        $this->showOneModal = false;
    }
    public function register()
    {
        $this->confirmingSaveInscription = true;
    }
    public function resetArreglo()
    {
        $this->reset('arreglo');
    }

    public function rangoFecha($inicio, $fin){
        return Period::query()
            ->join('course_details', 'periods.id', '=', 'course_details.period_id')
            ->join('courses', 'course_details.course_id', '=', 'courses.id')
            ->select(
                'periods.*',
                'course_details.id as curdet','course_details.*',
                'courses.*',
            )
            ->where('periods.fecha_inicio', '>=', $inicio)
            ->where('periods.fecha_fin', '<=', $fin);
    }

    public function addTabla2($id){

        if($this->countabla2<3){
            $cap=CourseDetail::select('course_details.capacidad')
                ->where('course_details.id',"=",$id)
                ->get();
            $users = CourseDetail::
                join('inscriptions as i', 'i.course_detail_id', '=', 'course_details.id')
                ->where('i.course_detail_id', "=",$id)
                ->where('i.estatus_participante', "=",'Participante')
                ->selectRaw('count(*) as user_count')
                ->first();
            if($users->user_count<$cap[0]->capacidad){
                $this->countabla2=$this->countabla2+1;
                array_push($this->arreglo1, $id);
                $this-> noti('success','Curso seleccionado ');
            }
            else{
                $this-> noti('danger','Capacidad llena del curso seleccionado');
            }
        }
        elseif($this->countabla2>2){
            $this-> noti('danger','No se pueden seleccionar más de 2 cursos por semana ',);
        }
        $this->buscar();
    }


    public function add($id){


        if($this->countabla1<3){
            $cap=CourseDetail::select('course_details.capacidad')
                             ->where('course_details.id',"=",$id)
                             ->get();
            $users = CourseDetail::
                join('inscriptions as i', 'i.course_detail_id', '=', 'course_details.id')
                ->where('i.course_detail_id', "=",$id)
                ->where('i.estatus_participante', "=",'Participante')
                ->selectRaw('count(*) as user_count')
                ->first();
            if($users->user_count<$cap[0]->capacidad){
                $this->countabla1=$this->countabla1+1;
                array_push($this->arreglo, $id);

                $this-> noti('success','Curso seleccionado ');
            }
            else{
                $this-> noti('danger','Capacidad llena del curso seleccionado');
            }
        }
        elseif($this->countabla1>2){
            $this-> noti('danger','No se pueden seleccionar más de 2 cursos por semana ');
        }
        $this->buscar();
    }
    public function tablaVacia(){
        if(count($this->buscar())!==0)
            $this->btnContinuar = true;
        else
            $this->btnContinuar = false;
    }
    public function buscar(){
        $this->unionarreglos=array_merge($this->arreglo,$this->arreglo1);
        $i = array_merge($this->arreglo,$this->arreglo1);
        return Period::query()
            ->join('course_details', 'periods.id', '=', 'course_details.period_id')
            ->join('courses', 'course_details.course_id', '=', 'courses.id')
            ->select('periods.*',
            'course_details.id as curdet','course_details.*',
            'courses.*')
            ->whereIn('course_details.id', $i)
            ->get();
    }

    public function render(){
        $this->tablaVacia();

        $this->obtenerPeriodos();

        return view('livewire.admin.inscriptions.index',
            [
                'tabla' => $this->buscar(),
                'semana1' => $this->rangoFecha($this->fecha_inicio_periodo1, $this->fecha_fin_periodo1)->paginate($this->perPage),
                'semana2' => $this->rangoFecha($this->fecha_inicio_periodo2, $this->fecha_fin_periodo2)->paginate($this->perPage2),
            ]
        );
    }

    public function obtenerPeriodos(){
        $fecha_actual = date("Y-m-d");

        $fecha_i_1=Period::select('periods.fecha_inicio')
                               ->where('periods.fecha_inicio','>',$fecha_actual)
                               ->first();

        $fecha_f_1=Period::select('periods.fecha_fin')
                               ->where('periods.fecha_inicio','>',$fecha_actual)
                               ->first();
        $this->fecha_inicio_periodo1= $fecha_i_1->fecha_inicio;
        $this->fecha_fin_periodo1= $fecha_f_1->fecha_fin;
        $this->fecha_inicio_periodo2=date("Y-m-d",strtotime($this->fecha_inicio_periodo1."+ 7 days"));
        $this->fecha_fin_periodo2=date("Y-m-d",strtotime($this->fecha_fin_periodo1."+ 7 days"));

    }

    public function del($id){
        foreach ($this->arreglo as $i) {
            if($i==$id){
                $this->countabla1=$this->countabla1-1;
                $indice1=array_search($id, $this->arreglo);
                unset($this->arreglo[$indice1]);
            }
        }

        foreach ($this->arreglo1 as $j) {
            if($j==$id){
                $this->countabla2=$this->countabla2-1;
                $indice2=array_search($id, $this->arreglo1);
                unset($this->arreglo1[$indice2]);
            }
        }
        $this->unionarreglos=array_merge($this->arreglo,$this->arreglo1);
        $this->buscar();
        $this-> noti('trash','Curso descartado');
    }

    public function addHorario(){

        $this->openShowHorario();
    }

    public function store(){
        $this->confirmingSaveInscription = false;
        $this->showHorario = false;

        $this->user = User::find(auth()->user()->id);
        foreach ($this->unionarreglos as $id) {
            $courseDetails = CourseDetail::find($id);
                $this->user->courseDetails()->attach( $courseDetails, [
                        'calificacion' => 0,
                        'estatus_participante' => 'Participante',
                        'asistencias_minimas' => 0,
                    ]);
        }

        $this-> noti('success','Horario creado Exitosamente');
    }

    public function noti($icon,$txt){
        $this->dispatchBrowserEvent('notify', [
            'icon' => $icon,
            'message' => $txt,
        ]);
    }

}
