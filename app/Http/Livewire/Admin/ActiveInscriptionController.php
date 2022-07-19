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
        // ->where('periods.fecha_inicio' , '<', Carbon::now()->addDays(60))
            ->orderBy('periods.fecha_inicio', 'asc')
            ->get();
    }

    // public function restablecerRoles(){
    //     $arreglo_id=[];
    //     $usuariosSinCambiar=[1,2,3];
    //     $consulta= User::join('inscriptions','inscriptions.user_id','users.id')
    //                     ->join('course_details','course_details.id','inscriptions.course_detail_id')
    //                     ->join('periods','periods.id','course_details.period_id')
    //                     ->select('users.id')
    //                     ->where('users.organizacion_origen','=','Tecnológico de oaxaca')

    //                     ->whereNotIn('users.id',$usuariosSinCambiar)
    //                     ->get();
    //     foreach($consulta as $co){
    //         array_push($arreglo_id,$co->id);
    //     }
    //     for($i=0;$i<count($consulta);$i++){
    //         $user = User::findOrFail($arreglo_id[$i]);
    //         $user->syncRoles('Participante');
    //     }
    // }
    public function render(){
        $this->fecha = $this->consulta();
        return view('livewire.admin.activeinscription.index');
    }
    public function publicar($id){
        DB::table('periods')
            ->where('periods.id','=',$id)
            ->update(['ofertado' => 1]);

        $this-> noti('success','Inscripciones publicas');
    }
    public function ocultar($id){
        DB::table('periods')
            ->where('periods.id','=',$id)
            ->update(['ofertado' => 0]);

        $this-> noti('success','Inscripciones ocultas');
    }
    public function desactivar(){
        // dd('DEsactivaste curso');
        $this-> noti('close','Inscripciones Desactivadas');
    }
    public function noti($icon,$txt){
        $this->dispatchBrowserEvent('notify', [
            'icon' => $icon,
            'message' => $txt,
        ]);
    }
}
