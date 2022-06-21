<?php

namespace App\Http\Livewire\Admin;

use App\Models\Period;
use Illuminate\Support\Carbon;
use Livewire\Component;

class ActiveInscriptionController extends Component
{   

    public $hoy;
    public $fecha;

    public $periodos;
    
    public function mount(){
        $this->hoy = date('Y/m/d');
        $this->fecha = $this->consulta();
    }
    public function consulta(){
        return Period::where('periods.fecha_inicio','>',$this->hoy)
        ->where('periods.fecha_inicio' , '<', Carbon::now()->addDays(90))
            ->orderBy('periods.fecha_inicio', 'asc')
            ->get();
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
