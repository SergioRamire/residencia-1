<?php

namespace App\Http\Livewire\Admin;

use DateTime;
use Livewire\Component;

class ActiveInscriptionController extends Component
{   

    public $id_periodo;


    public function render()
    {
        return view('livewire.admin.activeinscription.index');
    }
    /* obtener el valor de period [id] */
    protected $listeners = [
        'per_send',
    ];
    public function per_send($valor){
        $this->id_periodo = $valor;
    }
    public function activar()
    {
        dd('Activaste curso');
    }
    public function desactivar()
    {
        dd('DEsactivaste curso');
    }
    public $fecha_actual ;
    public function fechas(){
    }
}
