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
