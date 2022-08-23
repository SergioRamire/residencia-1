<?php

namespace App\Http\Livewire\Admin;

use App\Models\Period;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PostPeriodController extends Component
{

    public $hoy;
    public $fecha;

    public $periodos;
    public $aux_id;
    public bool $confirming_change = false;
    public bool $flag = false;

    public function black_periodo(){
        $this->periodos = Period::make();
    }
    public function consulta(){
        $this->hoy = date('Y/m/d');
        return Period::where('periods.fecha_inicio','>',$this->hoy)
            ->orderBy('periods.fecha_inicio', 'asc')
            ->get();
    }

    public function render(){
        $this->fecha = $this->consulta();
        return view('livewire.admin.postPeriod.index');
    }

    public function abrir_confirmacion_publicar($id){
        $this->flag = true;
        $this->periodos = Period::find($id);
        $periodos_publicados = Period::
                where('periods.ofertado', "=",1)
                ->selectRaw('count(*) as period_count')
                ->first();
                $this->aux_id = $id;
                $this->confirming_change = true;

    }
    public function abrir_confirmacion_ocultar($id){
        $this->flag = false;
        $this->periodos = Period::find($id);
        $this->aux_id = $id;
        $this->confirming_change = true;

    }

    public function publicar(){
        if ($this->flag) {
            DB::table('periods')
            ->where('periods.id','=',$this->aux_id)
            ->update(['ofertado' => 1]);
            $this-> noti('success','Inscripciones publicas');

        }else {
            DB::table('periods')
            ->where('periods.id','=',$this->aux_id)
            ->update(['ofertado' => 0]);
            $this-> noti('success','Período oculto');
        }
        $this->confirming_change = false;
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
