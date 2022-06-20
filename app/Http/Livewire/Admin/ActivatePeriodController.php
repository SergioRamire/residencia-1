<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\CourseDetail;
use App\Models\Inscription;
use App\Models\Period;
use App\Models\User;

class ActivatePeriodController extends Component
{
    public $es;
    public $consulta;
    public $cantidad;
    public $arreglo_id = [];
    public $arreglo_estatus = [];
    public function cambioRoles(){
        return User::
        join('inscriptions', 'inscriptions.user_id', '=', 'users.id')

        ->join('course_details', 'course_details.id', '=', 'inscriptions.course_detail_id')
        ->join('periods','periods.id','=','course_details.period_id')
        ->select('users.name','inscriptions.user_id as id','inscriptions.estatus_participante')
        ->where('Periods.estado', '=',1)
        ->get();
    }
    // evaluar si fecha actual está en el periodo actual
    public function fecha(){
        $fecha_actual = date("Y-m-d");
        $fecha_i_1=Period::select('periods.fecha_inicio')
                               ->where('periods.estado','=',1)
                               ->first();

        $fecha_f_1=Period::select('periods.fecha_fin')
                                ->where('periods.estado','=',1)
                               ->first();

        $f_i= $fecha_i_1->fecha_inicio;
        $f_f= $fecha_f_1->fecha_fin;

        $this->consulta= User::join('inscriptions','inscriptions.user_id','users.id')
                    ->join('course_details','course_details.id','inscriptions.course_detail_id')
                    ->join('periods','periods.id','course_details.period_id')
                    ->select('inscriptions.user_id','inscriptions.estatus_participante')
                    ->where('periods.estado','=',1)
                    ->get();
        $this->cantidad=count($this->consulta);
        foreach($this->consulta as $co){
            array_push($this->arreglo_id,$co->user_id);
        }
        foreach($this->consulta as $co){
            array_push($this->arreglo_estatus,$co->estatus_participante);
        }
        if(($fecha_actual >= $f_i) && ($fecha_actual <= $f_f)) {

            for($i=0;$i<count($this->consulta);$i++){
                $user = User::findOrFail($this->arreglo_id[$i]);
                $user->syncRoles($this->arreglo_estatus[$i]);
            }
            $this->es='si está';

        } else {

            $this->es='no está';

        }
    }

    public function render()
    {
        $this->fecha();
        return view('livewire.admin.activatePeriod.index',[
            'va'=> $this->cambioRoles()
        ]);
    }
}
