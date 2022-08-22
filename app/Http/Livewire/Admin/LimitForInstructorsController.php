<?php

namespace App\Http\Livewire\Admin;

    use Livewire\Component;
    use App\Models\Period;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Validation\Rule;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LimitForInstructorsController extends Component{
    use AuthorizesRequests;

    public Period $period;
    public bool $disponible=true;
    public bool $modal_edit = false;
    public bool $modal_confirmacion = false;


    public function mount(){
        $this->blank_period();
    }
    public function updated($x){
        $this->validateOnly($x);
    }
    public function blank_period(){
        $this->period = Period::make();
    }
    public function updatingSearch(){
        $this->resetPage();
    }
    public function rules(): array{
        return ['period.fecha_limite_para_calificar' => ['required', 'date']];
    }

    public function periodos_proximos(){
        $fecha_actual=date('Y/m/d');
        $period = Period::where('periods.fecha_fin','>=',$fecha_actual)
        ->select('periods.id','periods.clave','periods.fecha_inicio',
        'periods.fecha_fin','periods.fecha_limite_para_calificar')
        ->get();
        // dd($period);
        if($period!=null)
            return $period;
        $this->disponible=false;
    }

    public function render(){
        $this->periodos_proximos();
        // dd($p->clave);
        return view('livewire.admin.limitForInstructors.index',[
           'periodos' => $this->periodos_proximos(),
        ]);
    }
    // public function consultar_clave(){
    //     $p= $this->periodo_activo();
    //     $this->period_id=$p->id;
    // }

    public function actualizar_fecha_limite(){
        $p= $this->periodos_proximos();
        $this->period_id=$p->id;
        DB::table('periods')
            ->where('periods.id','=',$this->period_id)
            ->update(['fecha_limite_para_calificar' => $this->limite_fecha]);
    }

    public function edit($id){
        $this->authorize('periods.edit');
        $this->period = Period::findOrfail($id);
        $this->modal_edit = true;
    }
    public function confirmar(){
        $this->validate();
        $this->modal_confirmacion = true;
    }
    public function save(){
        $this->period->save();
        $this->modal_confirmacion = false;
        $this->modal_edit = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' =>  'pencil' ,
            'message' =>  'Fecha límite cambiada exitosamente',
        ]);
    }
}
