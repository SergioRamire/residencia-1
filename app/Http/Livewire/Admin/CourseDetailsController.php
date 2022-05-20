<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use App\Http\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithPagination;

class CourseDetailsController extends Component
{
    use WithPagination;
    use WithSorting;

    public $perPage = '5';
    public $search = '';

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public function render()
    {
        return view('livewire.admin.coursedetails.index', [
            'detalles'=>CourseDetail::join('courses', 'courses.id', 'course_details.course_id')
            ->join('groups', 'groups.id', 'course_details.group_id')
            ->join('periods', 'periods.id', 'course_details.period_id')
            ->select('course_details.id', 'course_details.lugar', 'course_details.capacidad',
              'course_details.hora_inicio', 'course_details.hora_fin', 'courses.nombre as curso',
              'groups.nombre as grupo', 'periods.fecha_inicio', 'periods.fecha_fin')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage),
        ]);
    }
}
