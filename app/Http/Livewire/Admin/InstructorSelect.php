<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class InstructorSelect extends Component
{

    public $query;/* valor para buscar */
    public $contador;
    public $txt = 'Buscar Instructor';
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
        return view('livewire.admin.instructor-select',[
            'datos' => $this->consulta()
        ]);
    }

    public function consulta(){
        if (strcmp(strtolower($this->query), 'todos') === 0) {
            return User::all();
        } else {
            return User::when($this->query, fn ($query2, $b) => $query2
                ->where('users.rfc', 'like', "%$b%")
                ->orWhere('users.name', 'like', "%$b%"))
            ->select('users.id as id', 'users.name')
            ->get();
        }
    }
    public function full(){/* Muestra todos */
        $this->query = 'todos';
    }
    public function selectUser($valor){
        $aux = User::find($valor);
        $this->txt = $aux->rfc.' '.$aux->name.' '.$aux->apellido_paterno.' '.$aux->apellido_materno;
        $this->emit('user_send',$valor);
        $this->reset2();
    }
}
