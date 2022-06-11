<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarEmailCurso;

Use App\Models\CourseDetail;
use Illuminate\Support\Arr;

class EmailController extends Component
{
    public $arreglo=[];
    public $nombres=[];

    public function cursos($user,$unionarreglos){
        $count =0;
        foreach($unionarreglos as $curso){
            $algo= CourseDetail::join('courses','courses.id','=','course_details.course_id')
                    ->join('groups', 'groups.id', '=', 'course_details.group_id')
                    ->join('periods','periods.id','=','course_details.period_id')
                    ->select('courses.nombre as name', 'course_details.hora_inicio as horaini', 'course_details.hora_fin as horafin','groups.nombre as grupo', 'periods.fecha_inicio as fi','periods.fecha_fin as ff')
                    ->where('course_details.id','=',$curso)->get();
            $this->arreglo[$count]=$algo;
            $count++;
        }

        $this->send($user);
    }

    public function send($user){

        Mail::to($user->email)
            ->send(new EnviarEmailCurso($this->arreglo, $user));
    }

}
