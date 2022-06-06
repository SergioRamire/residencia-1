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
    public $numero = 1;
    public $filters = '';
    public $filters2 = '';
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public $edit = false;
    public $create = false;
    public $showEditCreateModal = false;
    public $confirmingPeriodDeletion = false;
    public $confirmingSavePeriod = false;

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
                'fecha_inicio' => ['required', 'date', 'unique:periods'],
                'fecha_fin' => ['required', 'date', 'unique:periods'],
            ]);
        }
        if ($this->create == true) {
            $this->validate([
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
            'message' =>  $this->edit ? 'Área actualizada exitosamente' : 'Área creada exitosamente',
        ]);
    }

    public function deletePeriod($id, $fi, $ff)
    {
        $this->period = Period::findOrFail($id);
        $this->fecha_inicio = $fi;
        $this->fecha_fin = $ff;
        $this->confirmingAreaDeletion = true;
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
}
