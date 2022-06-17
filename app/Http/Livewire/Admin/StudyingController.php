<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use Livewire\Component;

class StudyingController extends Component
{
    public $user;
    public function mount(){
        $this->user = auth()->user();
    }
    public function render()
    {
        return view('livewire.admin.studying.index', [
            'datos' => $this->consulta(),
        ]);
    }
    public function consulta()
    {
        return CourseDetail::join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('inscriptions', 'inscriptions.course_detail_id', '=', 'course_details.id')
            ->join('users', 'users.id', '=', 'inscriptions.user_id')
            // ->when($this->classification['periodo'], fn ($query, $search) => $query
            //     ->where('periods.id', '=', $search))
            ->select(
                'courses.clave as curso_clave',
                'courses.nombre as curso_nombre',
                'groups.nombre as nombre_grupo',
                // 
                'inscriptions.calificacion as califi',
                'periods.fecha_inicio as f1',
                'periods.fecha_fin as f2',
                'course_details.hora_inicio as h1',
                'course_details.hora_fin as h2',
            )
            ->where("users.id", $this->user->id)
            ->get();;
    }
}
