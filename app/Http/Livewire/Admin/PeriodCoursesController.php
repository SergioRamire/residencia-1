<?php

namespace App\Http\Livewire\Admin;

use App\Models\Period;
use App\Http\Traits\WithSorting;
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
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
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
            'periods'=>Period::distinct()
                     ->when($this->filters, function ($query, $b) {
                         return $query->where(function ($q) {
                             $q->where('fecha_inicio', '=', $this->filters);
                         });
                     })
                     ->orderBy($this->sortField, $this->sortDirection)
                     ->paginate($this->perPage),
        ]);
    }
}
