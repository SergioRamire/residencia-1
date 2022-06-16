<?php

namespace App\Http\Livewire\Admin;

use App\Models\Period;
use Livewire\Component;

class PeriodSelect extends Component
{
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
        return view('livewire.admin.period-select',[
            'datos' => $this->consulta()
        ]);
    }
    public function consulta(){
        if (strcmp(strtolower($this->query), 'todos') === 0) {
            return Period::all();
        }else{
            return Period::when($this->query, fn ($query2, $b) => $query2
            ->where('periods.fecha_inicio', 'like', "%$b%")
            ->orWhere('periods.fecha_fin', 'like', "%$b%"))
            ->get();
        }
            
    }
    public function full(){/* Muestra todos */
        $this->query = 'todos';
    }
    public function selectPer($valor){
        $this->emit('per_send',$valor);
        $this->reset2();
    }
}
