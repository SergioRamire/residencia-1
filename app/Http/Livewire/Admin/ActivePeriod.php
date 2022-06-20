<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ActivePeriod extends Component
{   

    public $id_periodo;
    public function render()
    {
        return view('livewire.admin.activeperiod.index');
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
}
