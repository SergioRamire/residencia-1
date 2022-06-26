<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;

class CourseSelect  extends Component{

    public $period;

/* Para resivir la variable que se envio en Emit */
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
        return view('livewire.admin.course-select',[
            'datos' => $this->consulta()
        ]);
    }
    public function consulta(){
        $this->valor = $this->query;/* cambio de valor en segunda variable, no afecta por el momento */
        if (strcmp(strtolower($this->valor), 'todos') === 0) {
            return Course::query()->select('courses.id as idc', 'courses.nombre', 'courses.clave')->get();
        } else {
            return Course::query()->select('courses.id as idc', 'courses.nombre', 'courses.clave')
            ->when($this->valor, fn ($query2, $b) => $query2
                ->where('courses.nombre', 'like', "%$b%")
                ->orWhere('courses.clave', 'like', "%$b%"))
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
        $this->emit('send_curso',$valor);
        $this->reset2();
    }
    
    protected $listeners = [
        'valorCurso',
    ];
    public $id_escojido;
    public function valorCurso($valor){
        $aux = Course::where('courses.id', '=', $valor)
            ->select('courses.nombre as name','courses.clave as clav')
            ->get();
        $this->txt = 'Buscar Curso';
        if (!empty($valor)) {
            $this->txt = $aux[0]->clav.' '.$aux[0]->name;
        }
        $this->id_escojido = $valor;
    }
}
