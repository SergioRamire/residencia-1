<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use Livewire\Component;
use Livewire\WithPagination;

class PeriodCoursesController extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
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
    }

    public function render()
    {
        return view('livewire.admin.periodCourses.index', [
            'periods'=>CourseDetail::distinct()
                     /* ->join('period_details','period_details.course_detail_id','course_detail_id') */
                     ->join('periods', 'periods.id', 'course_details.period_id')
                     ->join('courses', 'courses.id', 'course_details.course_id')
                     ->join('groups', 'groups.id', 'course_details.group_id')
                     ->select('courses.nombre as curso', 'groups.nombre as grupo', 'periods.fecha_inicio', 'periods.fecha_fin')
                     ->orderBy('periods.fecha_inicio')
                     ->paginate($this->perPage),
        ]);
    }
}
