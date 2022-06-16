<?php

namespace App\Http\Livewire\Admin;
use App\Models\CourseDetail;
use Livewire\Component;

class CourseDetailsSelect extends Component
{   
    public $id_periodo;/* Dependiente del periodo */
    protected $listeners = [
        'per_send',
    ];
    public function per_send($valor){
        $this->id_periodo = $valor;
    }
/* Para resivir la variable que se envio en Emit */


    public $query;/* valor para buscar */
    public $contador;
    public function mount(){/* metodo par ainicar variables */
        $this->reset2();
    }
    public function reset2(){/* reset de variables */
        $this->query = '';
        $this->contador = 0;
    }
    public function incrementContador(){/* Incrementador de contador para la seleccion con flechas*/
        if ($this->contador == count($this->consulta()) -1) {
            $this->contador = 0;
            return;
        }
        $this->contador ++;
    }
    public function decrementContador(){/* Decrementador de contador para la seleccion con flechas*/
        if ($this->contador == 0) {
            $this->contador = count($this->consulta()) -1;
            return;
        }
        $this->contador --;
    }
    public function render(){/* renderizacion de la vista donde regresa el arreglo para el select */
        return view('livewire.admin.course-details-select',[
            'datos' => $this->consulta()
        ]);
    }
    public function consulta(){
        $this->valor = $this->query;/* cambio de valor en segunda variable, no afecta por el momento */
        if (strcmp(strtolower($this->valor), 'todos') === 0) {
            return CourseDetail::join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->where('course_details.period_id', '=', $this->id_periodo )
            ->select('course_details.id as id', 'courses.nombre', 'courses.clave')
            ->get();
        } else {
            return CourseDetail::join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->where('course_details.period_id', '=', $this->id_periodo )
            ->when($this->valor, fn ($query2, $b) => $query2
                ->where('courses.nombre', 'like', "%$b%")
                ->orWhere('courses.clave', 'like', "%$b%"))
            ->select('course_details.id as id', 'courses.nombre', 'courses.clave')
            ->get();
        }
    }
    public function full(){/* Muestra todos */
        $this->query = 'todos';
    }
    public function selectCur($valor){

        $this->emit('data_send',$valor);
        $this->reset2();
    }
}
