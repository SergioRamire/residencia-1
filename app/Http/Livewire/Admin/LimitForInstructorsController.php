<?php

namespace App\Http\Livewire\Admin;

    use Livewire\Component;

class LimitForInstructorsController extends Component{

    public $clave ='1-ENE/JUN2022';
    public $fecha1 ='01/01/2022';
    public $fecha2 ='02/01/2022';
    public $estado = 1;
    public $limite_fecha;
    public $limite_hora;
    public function render(){
        return view('livewire.admin.limitForInstructors.index');
    }
    public function consultPeriodo(){
        
    }
}
