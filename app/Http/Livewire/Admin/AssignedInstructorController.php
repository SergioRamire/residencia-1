<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AssignedInstructorController extends Component{
    
    public $curso;
    public $grupo;
    public $instructor;
    public $lugar;
    public $horario1;
    public $horario2;
    public $search;

    public $id_detalle_de_curso = 5;

    public function resetFilters(){
        $this->reset('curso');
        $this->reset('grupo');
        $this->reset('lugar');
        $this->reset('horario1');
        $this->reset('horario2');
        $this->reset('instructor');
        $this->reset('search');
    }

    public function render(){
        $this->consultadeta();
        return view('livewire.admin.assignedInstructor.index', [
            'datoscurso' => $this->consultacurso(), //->paginate($this->perPage)
            'datosgrupo' => $this->consultagrupo(),
            'datosuser' => $this->consultauser()
        ]);
    }


    public function consultacurso(){
        return CourseDetail::query()
                ->Join('courses', 'courses.id', '=', 'course_details.course_id')
                ->select('courses.nombre as nombre_curso', 'courses.id', 'course_details.*')
                // ->when($this->search, function ($query, $search) {
                //     $query->where('rfc', 'like', "%$search%")
                //         ->orWhere(DB::raw("REPLACE(CONCAT_WS(' ', name, apellido_paterno, apellido_materno), '  ', ' ')"), 'like', "%$search%");
                //     }
                // ->where('course_details.id', '=', $this->id_detalle_de_curso)
                ->get();
    }
    public function consultagrupo(){
        return CourseDetail::query()
                ->Join('groups', 'groups.id', '=', 'course_details.group_id')
                ->select('groups.nombre as nombre_grupo', 'groups.id', 'course_details.*')
                // ->when($this->search, function ($query, $search) {
                //     $query->where('rfc', 'like', "%$search%")
                //         ->orWhere(DB::raw("REPLACE(CONCAT_WS(' ', name, apellido_paterno, apellido_materno), '  ', ' ')"), 'like', "%$search%");
                //     }
                // ->where('course_details.id', '=', $this->id_detalle_de_curso)
                ->get();
    }
    public function consultauser(){
        return CourseDetail::query()
            ->Join('inscriptions', 'inscriptions.course_detail_id', '=', 'course_details.course_id')
            ->Join('users', 'users.id', '=', 'inscriptions.user_id')
            ->select('users.*')
                // ->when($this->search, function ($query, $search) {
                //     $query->where('rfc', 'like', "%$search%")
                //         ->orWhere(DB::raw("REPLACE(CONCAT_WS(' ', name, apellido_paterno, apellido_materno), '  ', ' ')"), 'like', "%$search%");
                //     }
                // ->where('course_details.id', '=', $this->id_detalle_de_curso)
            ->get();
    }
    public function consultadetalle(){
        return CourseDetail::query()
            ->select('course_details.*')
                // ->when($this->search, function ($query, $search) {
                //     $query->where('rfc', 'like', "%$search%")
                //         ->orWhere(DB::raw("REPLACE(CONCAT_WS(' ', name, apellido_paterno, apellido_materno), '  ', ' ')"), 'like', "%$search%");
                //     }
                ->where('course_details.id', '=', $this->id_detalle_de_curso)
            ->get();
    }

    public function consultadeta(){
        $this->lugar = $this->consultadetalle()[0]['lugar'];
        $this->horario1= $this->consultadetalle()[0]['hora_inicio'];
        $this->horario2= $this->consultadetalle()[0]['hora_fin'];
    }


}
