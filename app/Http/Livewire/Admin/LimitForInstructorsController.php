<?php

namespace App\Http\Livewire\Admin;

    use Livewire\Component;
    use App\Models\Period;
    use Illuminate\Support\Facades\DB;

class LimitForInstructorsController extends Component{

    public $clave ='1-ENE/JUN2022';
    public $fecha1 ='01/01/2022';
    public $fecha2 ='02/01/2022';
    public $estado = 1;
    public $limite_fecha;
    public $limite_hora;
    public $period;
    public $period_id;

    public bool $modalEdit = false;
    public bool $modalConfirmacion = false;

    public function periodo_activo(){
        $period = Period::select('periods.id','periods.clave','periods.fecha_inicio','periods.fecha_fin')
                        ->where('periods.estado','=',1)
                        ->first();
        return $period;
    }

    public function render(){
        $p= $this->periodo_activo();
        $this->consultar_clave();
        // dd($p->clave);
        return view('livewire.admin.limitForInstructors.index',[
           'periodos' => $p
        ]);
    }
    public function consultar_clave(){
        $p= $this->periodo_activo();
        $this->period_id=$p->id;
    }

    public function actualizar_fecha_limite(){
        DB::table('periods')
            ->where('periods.id','=',$this->period_id)
            ->update(['fecha_limite_para_calificar' => $this->limite_fecha]);
    }
    public function edit($id){
        $this->modalEdit = true;
    }
    public function confirmar(){
        $this->modalConfirmacion = true;
    }
    public function save(){
        
        $this->modalConfirmacion = false;
        $this->modalEdit = false;
    }
}
