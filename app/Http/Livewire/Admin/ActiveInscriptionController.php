<?php

namespace App\Http\Livewire\Admin;

use App\Models\Period;
use Illuminate\Support\Carbon;
use Livewire\Component;

class ActiveInscriptionController extends Component
{   

    public $hoy;
    public $fecha;
    
    public function mount(){
        $this->hoy = date('Y/m/d');
        $this->fecha = $this->consulta();
    }
    public function consulta()
    {
        return Period::where('periods.fecha_inicio','>',$this->hoy)
            ->orderBy('periods.fecha_inicio', 'asc')
            ->first();
    }
    public function render()
    {
        return view('livewire.admin.activeinscription.index');
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
