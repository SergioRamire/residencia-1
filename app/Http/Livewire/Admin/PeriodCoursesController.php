<?php

namespace App\Http\Livewire\Admin;

use App\Models\Period;
use Livewire\Component;
use Livewire\WithPagination;

class PeriodCoursesController extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $numero = 1;
    public $filters = '';
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('search');
        $this->reset('filters');
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
                     ->orderBy('fecha_inicio')
                     ->paginate($this->perPage),
        ]);
    }
}
