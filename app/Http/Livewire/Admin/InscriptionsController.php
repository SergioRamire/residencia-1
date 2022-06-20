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
    public int $countabla1 = 1;
    public int $countabla2 = 1;
    public $horas_inicio=[];
    public $id_arreglo=[];
    public $id_arreglo1=[];

    public bool $btnContinuar = false;
    public bool $showHorario = false;
    public bool $confirmingSaveInscription = false;
    protected $queryString = [
        'perPage' => ['except' => 5, 'as' => 'p'],
        'perPage2' => ['except' => 3, 'as' => 'p2'],
    ];

    public bool $valorbtn1 = false;
    public bool $valorbtn2 = false;

    public function switchbtn1(){
        $this->valorbtn1 = $this->alternar($this->valorbtn1);
        if ($this->valorbtn2 == true) {
            $this->valorbtn2 = $this->alternar($this->valorbtn2);
        }
    }

    public function switchbtn2(){
        $this->valorbtn2 = $this->alternar($this->valorbtn2);
        if ($this->valorbtn1 == true) {
            $this->valorbtn1 = $this->alternar($this->valorbtn1);
        }
    }

    public function alternar($valor){
        if($valor){
            $valor = false;
        }else{
            $valor = true;
        }
        return $valor;
    }

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
                $h=CourseDetail::select('course_details.hora_inicio')
                            ->where('course_details.id', "=",$id)
                            ->get();
                $hi=$h[0]->hora_inicio;
                if(in_array($hi,$this->horas_inicio)){
                    $this-> noti('info','Ya escogiste un curso con el cual se empalma');
                }
                else{
                    array_push($this->horas_inicio,$hi);
                    $this->countabla2=$this->countabla2+1;
                    array_push($this->arreglo1, $id);
                    array_push($this->id_arreglo1, $id);
                    $this-> noti('success','Curso seleccionado ');
                }
            }
            else{
                $this-> noti('info','Capacidad llena del curso seleccionado');
            }
        }
        elseif($this->countabla2>2){
            $this-> noti('info','No se pueden seleccionar más de 2 cursos por semana ',);
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
                $h=CourseDetail::select('course_details.hora_inicio')
                            ->where('course_details.id', "=",$id)
                            ->get();
                $hi=$h[0]->hora_inicio;
                if(in_array($hi,$this->horas_inicio)){
                    $this-> noti('info','Ya escogiste un curso con el cual se empalma');
                }
                else{
                    array_push($this->horas_inicio,$hi);
                    $this->countabla1=$this->countabla1+1;
                    array_push($this->arreglo, $id);
                    array_push($this->id_arreglo, $id);
                    $this-> noti('success','Curso seleccionado ');
                }
            }
            else{
                $this-> noti('info','Capacidad llena del curso seleccionado');
            }
        }
        elseif($this->countabla1>2){
            $this-> noti('info','No se pueden seleccionar más de 2 cursos por semana ');
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

    public function rangoFecha($inicio){
        $a=$this->id_arreglo;
        $b=$this->id_arreglo1;
        return Period::query()
            ->join('course_details', 'periods.id', '=', 'course_details.period_id')
            ->join('courses', 'course_details.course_id', '=', 'courses.id')
            ->select(
                'periods.*',
                'course_details.id as curdet','course_details.*',
                'courses.*',
            )
            ->where('periods.fecha_inicio', '=', $inicio)
            ->whereNotIn('course_details.id',$a)
            ->whereNotIn('course_details.id',$b);
    }

    public function render(){
        $this->tablaVacia();
        return view('livewire.admin.inscriptions.index',
            [
                'tabla' => $this->buscar(),
                'semana1' => $this->rangoFecha('2022-06-20')->paginate($this->perPage),
                'semana2' => $this->rangoFecha('2022-06-27')->paginate($this->perPage2),
            ]
        );
    }

    public function del($id){
        if(in_array($id,$this->arreglo)){
            $this->countabla1=$this->countabla1-1;
            $indice1=array_search($id, $this->arreglo);
            $indice2=array_search($id, $this->id_arreglo);
            unset($this->arreglo[$indice1]);
            unset($this->id_arreglo[$indice2]);
        }
        elseif(in_array($id,$this->arreglo1)){
            $this->countabla2=$this->countabla2-1;
            $indice3=array_search($id, $this->arreglo1);
            $indice4=array_search($id, $this->id_arreglo1);
            unset($this->arreglo1[$indice3]);
            unset($this->id_arreglo1[$indice4]);
        }
        $indice5=array_search($id, $this->horas_inicio);
        unset($this->horas_inicio[$indice5]);
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
        

        return redirect()->route('participant.studying');
        // $this-> noti('success','Horario creado Exitosamente');
    }

    // public function Obtenerusuariosinscritospreviamente(){
    //     $this->user = User::find(auth()->user()->id);
    //     $consulta = CourseDetail::Join('inscriptions','inscriptions.user_id')
    //                         ->select('course_details.')
    //     if()
    // }

    public function noti($icon,$txt){
        $this->dispatchBrowserEvent('notify', [
            'icon' => $icon,
            'message' => $txt,
        ]);
    }
    /* Para cambiar al modal final para redirecion */
    public bool $flag = false;  

    public function alter()
    {
        $this->confirmingSaveInscription = false;
        $this->flag = true;
    }

    /* Verificacion si hay cursos */
    public $disponible = true;
    
}
