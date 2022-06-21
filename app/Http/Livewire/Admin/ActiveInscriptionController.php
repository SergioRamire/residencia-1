<?php

namespace App\Http\Livewire\Admin;

use App\Models\Period;
use App\Models\User;
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

    public function restablecerRoles(){
        $arreglo_id=[];
        $usuariosSinCambiar=[1,2,3];
        $consulta= User::join('inscriptions','inscriptions.user_id','users.id')
                        ->join('course_details','course_details.id','inscriptions.course_detail_id')
                        ->join('periods','periods.id','course_details.period_id')
                        ->select('users.id')
                        ->where('users.organizacion_origen','=','Tecnológico de oaxaca')

                        ->whereNotIn('users.id',$usuariosSinCambiar)
                        ->get();
        foreach($consulta as $co){
            array_push($arreglo_id,$co->id);
        }
        for($i=0;$i<count($consulta);$i++){
            $user = User::findOrFail($arreglo_id[$i]);
            $user->syncRoles('Participante');
        }
    }
    public function render()
    {
        return view('livewire.admin.activeinscription.index');
    }


    public function activar()
    {
        $this->restablecerRoles();
        // dd('Activaste curso');
    }
    public function desactivar()
    {
        dd('DEsactivaste curso');
    }
}
