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

    public bool $modalEdit = false;
    public bool $modalConfirmacion = false;

    
    public function mount(){
        $this->blankPeriod();
    }
    public function updated($x){
        $this->validateOnly($x);
    }
    public function blankPeriod(){
        $this->period = Period::make();
    }
    public function updatingSearch(){
        $this->resetPage();
    }
    public function rules(): array{
        return ['period.fecha_limite_para_calificar' => ['required', 'date']];
    }
    
    public function periodo_activo(){
        $period = Period::select('periods.id','periods.clave','periods.fecha_inicio','periods.fecha_fin','periods.fecha_limite_para_calificar')
            ->where('periods.estado','=',1)
            ->first();
        return $period;
    }

    public function render(){
        $this->consultar_clave();
        // dd($p->clave);
        return view('livewire.admin.limitForInstructors.index',[
           'periodos' => $this->periodo_activo()
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
        $this->authorize('periods.edit');
        $this->period = Period::findOrfail($id);
        $this->modalEdit = true;
    }
    public function confirmar(){
        $this->validate();
        $this->modalConfirmacion = true;
    }
    public function save(){
        $this->period->save();
        $this->modalConfirmacion = false;
        $this->modalEdit = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' =>  'pencil' ,
            'message' =>  'Fecha límite cambiada exitosamente',
        ]);
    }
}
