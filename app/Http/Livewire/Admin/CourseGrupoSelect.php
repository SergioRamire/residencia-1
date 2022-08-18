<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use App\Models\CourseDetail;
use Livewire\Component;

class CourseGrupoSelect extends Component{
    public $period;
    public $query;/* valor para buscar */
    public $contador;
    public $txt = 'Buscar Curso';
    public function mount(){/* metodo par ainicar variables */
        $this->reset2();
    }
    public function reset2(){/* reset de variables */
        $this->query = '';
        $this->contador = 0;
    }

    public function render(){/* renderizacion de la vista donde regresa el arreglo para el select */
        return view('livewire.admin.course-grupo-select',[
            'datos' => $this->consulta()
        ]);
    }
    public function consulta(){
        $this->valor = $this->query;/* cambio de valor en segunda variable, no afecta por el momento */
        if (strcmp(strtolower($this->valor), 'todos') === 0) {
            return CourseDetail::join('courses', 'courses.id', '=', 'course_details.course_id')
                ->join('groups', 'groups.id', '=', 'course_details.group_id')
                ->join('periods', 'periods.id', '=', 'course_details.period_id')
                ->where('periods.id',$this->id_perper)
                ->where('course_details.estatus', 1)
                ->select('course_details.id as idc', 'courses.nombre', 'courses.clave', 'groups.nombre as gruponombre')
                ->get();
        } else {

            return CourseDetail::join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->where('periods.id',$this->id_perper)
            ->where('course_details.estatus', 1)
            ->when($this->valor, fn ($query2, $b) => $query2
                ->where('courses.nombre', 'like', "%$b%")
                ->orWhere('courses.clave', 'like', "%$b%"))
            ->select('course_details.id as idc', 'courses.nombre', 'courses.clave', 'groups.nombre as gruponombre')
            ->get();
        }
    }
    public function full(){/* Muestra todos */
        $this->query = 'todos';
    }
    public function selectCur($valor){
        $aux = Course::where('courses.id', '=', $valor)
        ->select('courses.nombre as name','courses.clave as clav')
        ->get();
        $this->txt =  $aux[0]->clav.' '.$aux[0]->name;
        $this->emit('send_curso_grupo',$valor);
        $this->reset2();
    }
    
    protected $listeners = [
        'valorCursoGrupo',
        'per_send2',
        'valorPerio',
    ];
    public $id_escojido;

    public function valorCursoGrupo($valor){
        // $aux = Course::where('courses.id', '=', $valor)
        //     ->select('courses.nombre as name','courses.clave as clav')
        //     ->get();
        $aux = CourseDetail::join('courses', 'courses.id', '=', 'course_details.course_id')
                ->join('groups', 'groups.id', '=', 'course_details.group_id')
                ->where('course_details.id', '=', $valor)
                ->select('courses.id as idc', 'courses.nombre as name', 
                    'courses.clave as clav', 'groups.nombre as gruponombre')
                ->get();
        $this->txt = 'Buscar Curso';
        if (!empty($valor)) {
            $this->txt = $aux[0]->gruponombre.' '.$aux[0]->clav.' '.$aux[0]->name;
        }
        $this->id_escojido = $valor;
    }
    public $id_perper;

    public function per_send2($valor){
        $this->id_perper = $valor;
    }
    public function valorPerio($valor){
        $this->id_perper = $valor;
    }
}
