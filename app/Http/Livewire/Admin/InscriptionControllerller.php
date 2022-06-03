<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Period;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class InscriptionControllerller extends Component
{
    public User $user;
    public int $perPage = 5;
    public $arreglo = [];
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
        $this->countabla2=$this->countabla2+1;
        if($this->countabla2<=3){
        array_push($this->arreglo, $id);

        // $this->updatecache($this->keyCache, $this->arreglo);

            $this-> noti('success','Curso seleccionado ');
        }
        else{
            $this-> noti('danger','No se pueden seleccionar más de 2 cursos por semana ',);
        }
    }


    public function add($id){
        $this->countabla1=$this->countabla1+1;
        if($this->countabla1<=3){
        array_push($this->arreglo, $id);

        // $this->updatecache($this->keyCache, $this->arreglo);

            $this-> noti('success','Curso seleccionado ');
        }
        else{
            $this-> noti('danger','No se pueden seleccionar más de 2 cursos por semana ',);
        }

    }
    public function tablaVacia(){
        if(count($this->buscar())!==0)
            $this->btnContinuar = true;
        else
            $this->btnContinuar = false;
    }
    public function buscar(){
        $i = $this->arreglo;
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
        // $this->addcache();
        return view('livewire.admin.inscriptions.index',
            [
                'tabla' => $this->buscar(),
                'semana1' => $this->rangoFecha('2022-06-10', '2022-06-18')->paginate($this->perPage),
                'semana2' => $this->rangoFecha('2022-06-21', '2022-06-28')->paginate($this->perPage),
            ]
        );
    }

    public function del($id){

        $indice=array_search($id, $this->arreglo);
        unset($this->arreglo[$indice]);
        $this->countabla1=$this->countabla1-2;
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
        foreach ($this->arreglo as $id) {
            $courseDetails = CourseDetail::find($id);
            $this->user->courseDetails()->attach( $courseDetails, [
                        'calificacion' => 0,
                        'estatus_participante' => 'Participante',
                        'asistencias_minimas' => 0,
                    ]);
        }
        $this-> noti('success','Horario creado Exitosamente');
    }

}
