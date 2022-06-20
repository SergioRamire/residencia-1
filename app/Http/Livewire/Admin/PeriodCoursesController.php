<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSorting;
use App\Models\Period;
use Livewire\Component;
use Livewire\WithPagination;

class PeriodCoursesController extends Component
{
    use WithPagination;
    use WithSorting;

    public Period $period;
    public $perPage = 5;
    public $search = '';
    public $periodo_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $clave;
    public $numero = 1;
    public $filters = '';
    public $filters2 = '';
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public bool $edit = false;
    public bool $create = false;
    public bool $showEditCreateModal = false;
    public bool $confirmingPeriodDeletion = false;
    public bool $confirmingSavePeriod = false;
    public bool $confirmingPeriodActive =false;
    public bool $confirmingPeriodInactive =false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('search');
        $this->reset('filters');
        $this->reset('filters2');
    }

    private function validateInputs()
    {
        if ($this->edit == true) {
            $this->validate([
                'clave' => ['required', 'unique:periods'],
                'fecha_inicio' => ['required', 'date'],
                'fecha_fin' => ['required', 'date'],
            ]);
        }
        if ($this->create == true) {
            $this->validate([
                'clave' => ['required', 'unique:periods'],
                'fecha_inicio' => ['required', 'date', 'unique:periods'],
                'fecha_fin' => ['required', 'date', 'unique:periods'],
            ]);
        }
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
        $this->confirmingPeriodDeletion = false;
        $this->confirmingSavePeriod = false;
        $this->edit = false;
        $this->create = true;
    }

    public function openModal()
    {
        $this->showEditCreateModal = true;
    }

    public function closeModal()
    {
        $this->showEditCreateModal = false;
    }

    private function resetInputFields()
    {
        $this->periodo_id = '';
        $this->clave = '';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
    }

    public function updatePeriod()
    {
        $this->validateInputs();
        $this->confirmingSavePeriod = true;
    }

    public function edit($id)
    {
        $period = Period::findOrFail($id);
        $this->periodo_id = $id;
        $this->clave = $period->clave;
        $this->fecha_inicio = $period->fecha_inicio;
        $this->fecha_fin = $period->fecha_fin;
        $this->edit = true;
        $this->create = false;
        $this->openModal();
    }

    public function store()
    {
        // $this->validateInputs();

        Period::updateOrCreate(['id' => $this->periodo_id], [
            'clave' => $this->clave,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
        ]);

        $this->edit = false;
        $this->create = false;
        $this->confirmingSaveArea = false;
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->showEditCreateModal = false;
        $this->confirmingPeriodDeletion = false;
        $this->confirmingSavePeriod = false;
        $this->resetInputFields();

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Periodo actualizado exitosamente' : 'Periodo creado exitosamente',
        ]);
    }

    public function deletePeriod($id, $fi, $ff)
    {
        $this->period = Period::findOrFail($id);
        $this->fecha_inicio = $fi;
        $this->fecha_fin = $ff;
        $this->confirmingPeriodDeletion = true;
    }

    public function delete()
    {
        $this->period->delete();
        $this->confirmingPeriodDeletion = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Periodo eliminado exitosamente',
        ]);
        $this->resetInputFields();
    }

    public function periodoActivar($id){
        $period = Period::findOrFail($id);
        $this->periodo_id = $id;
        $this->confirmingPeriodActive=true;
    }
    public function periodoDesactivar($id){
        $period = Period::findOrFail($id);
        $this->periodo_id = $id;
        $this->confirmingPeriodInactive=true;
    }

    public function activar(){
        Period::updateOrCreate(['id' => $this->periodo_id], [
            'estado' => 1,
        ]);
        $this->confirmingPeriodActive=false;
    }
    public function desactivar(){
        Period::updateOrCreate(['id' => $this->periodo_id], [
            'estado' => 0,
        ]);
        $this->confirmingPeriodInactive=false;
    }

    public function render()
    {
        return view('livewire.admin.periodCourses.index', [
            'periods' => Period::query()
                ->when($this->filters, function ($query, $b) {
                    return $query->where(function ($q) {
                        $q->where('fecha_inicio', '>=', $this->filters);
                    });
                })
                ->when($this->filters2, function ($query, $b) {
                    return $query->where(function ($q) {
                        $q->where('fecha_fin', '<=', $this->filters2);
                    });
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
    
    public $modalConfirmacion;
    public bool $estadox = false;
    public $color = 'red';

    public function act($id){        
        $this->modalConfirmacion = true;
        $this->estadox = true;
        $this->color = 'green';
    }

    public function des($id){
        $this->modalConfirmacion = true;
        $this->estadox = false;
        $this->color = 'red';
    }

    public function confirmar(){
        if ($this->estadox) {
            $this->estadox = false;
        }else {
            $this->estadox = true;
        }
        $this->modalConfirmacion = false;
    }
}
