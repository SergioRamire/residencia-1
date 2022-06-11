<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Period;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

use App\Http\Livewire\Admin\EmailController;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarEmailCurso;


class InscriptionsController extends Component
{
    public User $user;
    public int $perPage = 5;
    public $arreglo = [];
    public $arreglo1 = [];
    public $unionarreglos = [];
    public $keyCache = 'horario'; /* .auth()->user()->id; */
    public int $countabla1 = 1;
    public int $countabla2 = 1;

    public bool $btnContinuar = false;
    public bool $showHorario = false;
    public bool $confirmingSaveInscription = false;

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
            $this->countabla2=$this->countabla2+1;
            array_push($this->arreglo1, $id);
            $this-> noti('success','Curso seleccionado ');
        }
        elseif($this->countabla2>2){
            $this-> noti('danger','No se pueden seleccionar más de 2 cursos por semana ',);
        }
        $this->buscar();
    }


    public function add($id){


        if($this->countabla1<3){
            $this->countabla1=$this->countabla1+1;
            array_push($this->arreglo, $id);

            $this-> noti('success','Curso seleccionado ');
        }
        elseif($this->countabla1>2){
            $this-> noti('danger','No se pueden seleccionar más de 2 cursos por semana ');
            return;
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
        return view('livewire.admin.inscriptions.index',
            [
                'tabla' => $this->buscar(),
                'semana1' => $this->rangoFecha('2022-06-02', '2022-06-10')->paginate($this->perPage),
                'semana2' => $this->rangoFecha('2022-06-05', '2022-06-18')->paginate($this->perPage),
            ]
        );
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


        app(EmailController::class)->cursos($this->user, $this->unionarreglos);
        $this-> noti('success','Horario creado Exitosamente');
    }

    public function noti($icon,$txt){
        $this->dispatchBrowserEvent('notify', [
            'icon' => $icon,
            'message' => $txt,
        ]);
    }



}
