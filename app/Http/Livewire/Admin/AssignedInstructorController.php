<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use App\Models\User;
use App\Models\Period;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AssignedInstructorController extends Component{


    public $datos='';
    public $lugar='';
    public $horai;
    public $horaf;
    public $id_instructor;
    public array $classification = [
        'curso' => '',
        'periodo' => '',
        'grupo' => '',
    ];


    public $id_detalle_curso;

    public function resetFilters(){
        $this->reset('curso');
        $this->reset('grupo');
        $this->reset('lugar');
        $this->reset('horai');
        $this->reset('horaf');
    }

    public function render(){
         $this->valores();
        return view('livewire.admin.assignedInstructor.index', [
            'datoscurso' => $this->consultacurso($this->classification['periodo'], $this->classification['curso'],$this->classification['grupo']),
            'datosuser' => $this->consultauser()
        ]);
    }

    public function valores(){
        $this->datos=$this->consultacurso($this->classification['periodo'], $this->classification['curso'],$this->classification['grupo']);
        if(count($this->datos)>0){
            $this->id_detalle_curso=$this->datos[0]->id;
            $this->lugar=$this->datos[0]->lugar;
            $this->horai=$this->datos[0]->hora_inicio;
            $this->horaf=$this->datos[0]->hora_fin;
        }
    }
    public function consultacurso($idp,$idc,$idg){
        return CourseDetail::query()
                ->select('course_details.id','course_details.lugar','course_details.capacidad','course_details.hora_inicio'
                        ,'course_details.hora_fin','course_details.capacidad')
                ->where( 'course_details.period_id','=',$idp)
                ->where( 'course_details.course_id','=',$idc)
                ->where( 'course_details.group_id','=',$idg)
                ->get();
    }
    public function consultauser(){
        return User::query()
            ->select('users.*')
            ->get();
    }

    public function registrar(){
        $this->user = User::find($this->id_instructor);
        $courseDetails = CourseDetail::find($this->id_detalle_curso);
            $this->user->courseDetails()->attach( $courseDetails, [
                        'calificacion' => 0,
                        'estatus_participante' => 'Instructor',
                        'asistencias_minimas' => 0,
                    ]);
        $this-> noti('success','Instructor asignado correctamente');
    }

    public function noti($icon,$txt){
        $this->dispatchBrowserEvent('notify', [
            'icon' => $icon,
            'message' => $txt,
        ]);
    }

}
