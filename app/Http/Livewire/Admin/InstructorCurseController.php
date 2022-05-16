<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class InstructorCurseController extends Component
{
    use WithPagination;

    public $perPage = '8';
    public $search = '';

    // protected array $cleanStringsExcept = ['search'];

    //variable filtro de curso
    public $filters = [
        'filtro_curso' => '',
        'filtro_calificacion'=>'',
        'fecha_inicio' => '',
        'fecha_fin' => '',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage',
    ];


    public function updatingFilters()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('search');
    }

    public function resetFilters2()
    {
         $this->reset('filters');
    }

    public function render()
    {
        return view('livewire.admin.instructor.index', [
            'instructor' =>  CourseDetail::query()
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('inscriptions', 'inscriptions.course_detail_id', '=', 'course_details.id')
            ->join('users', 'users.id', '=', 'inscriptions.user_id')
            ->join('period_details','period_details.course_detail_id', '=', 'course_details.id')
            ->join('periods', 'periods.id', '=', 'period_details.period_id')
            ->select('users.name', 'users.apellido_paterno', 'users.apellido_materno', 'courses.nombre as curso', 'inscriptions.estatus_participante', 'periods.fecha_inicio as fi','periods.fecha_fin as ff')
            ->where('inscriptions.estatus_participante', '=', 'Instructor')
            ->when($this->search, function ($query, $b) {
                return $query->where(function ($q) {
                    $q->Where(DB::raw("concat(users.name,' ',users.apellido_paterno,
                      ' ', users.apellido_materno)"), 'like', '%'.$this->search.'%')
                      ->orWhere('courses.nombre', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->filters['filtro_curso'], function ($query, $b) {
                return $query->where(function ($q) {
                    $q->where('courses.nombre', 'like', '%'.$this->filters['filtro_curso'].'%')
                    ->where('inscriptions.estatus_participante', '=', 'Instructor');
                });
            })
            ->when($this->filters['fecha_inicio'], function ($query, $b) {
                return $query->where(function ($q) {
                    $q->where('periods.fecha_inicio', 'like', '%'.$this->filters['fecha_inicio'].'%');
                });
            })
            ->when($this->filters['fecha_fin'], function ($query, $b) {
                return $query->where(function ($q) {
                    $q->where('periods.fecha_fin', 'like', '%'.$this->filters['fecha_fin'].'%');
                });
            })
            ->orderBy('users.name', 'asc')
            ->paginate($this->perPage),
        ]);
    }
}
