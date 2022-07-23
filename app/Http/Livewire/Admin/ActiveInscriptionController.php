<?php

namespace App\Http\Livewire\Admin;

use App\Models\Period;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ActiveInscriptionController extends Component
{

    public $hoy;
    public $fecha;

    public $periodos;

    public function consulta(){
        $this->hoy = date('Y/m/d');
        return Period::where('periods.fecha_inicio','>',$this->hoy)
                ->where('periods.fecha_inicio' , '<', Carbon::now()->addDays(60))
            ->orderBy('periods.fecha_inicio', 'asc')
            ->get();
    }

    public function render(){
        $this->fecha = $this->consulta();
        return view('livewire.admin.activeinscription.index');
    }
    public function publicar($id){
        $periodos_publicados = Period::
                where('periods.ofertado', "=",1)
                ->selectRaw('count(*) as period_count')
                ->first();
        if($periodos_publicados->period_count < 2){
            DB::table('periods')
            ->where('periods.id','=',$id)
            ->update(['ofertado' => 1]);
            $this-> noti('success','Inscripciones publicas');
        }
        else{
            $this-> noti('info','No se pueden publicar mas de dos periodos ');
        }

    }
    public function ocultar($id){
        DB::table('periods')
            ->where('periods.id','=',$id)
            ->update(['ofertado' => 0]);

        $this-> noti('success','Inscripciones ocultas');
    }
    public function desactivar(){
        $this-> noti('close','Inscripciones Desactivadas');
    }
    public function noti($icon,$txt){
        $this->dispatchBrowserEvent('notify', [
            'icon' => $icon,
            'message' => $txt,
        ]);
    }
}
