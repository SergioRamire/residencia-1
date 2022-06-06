<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSorting;
use App\Models\Course;
use App\Models\CourseDetail;
use Livewire\Component;
use Livewire\WithPagination;

class CourseDetailsController extends Component
{
    use WithPagination;
    use WithSorting;

    public CourseDetail $coursedetail;
    public $perPage = '5';
    public $search = '';
    public $curso;
    public $coursedetail_id;
    public $grupo_id;
    public $fecha_inicio;
    public $hora_inicio;
    public $hora_fin;
    public $capacidad;
    public $lugar;
    public $busq;
    public $edit = false;
    public $create = false;

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public $showEditCreateModal = false;
    public $confirmingDetailsDeletion = false;
    public $confirmingSaveDetails = false;

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
        $this->curso = '';
        $this->grupo_id = '';
        $this->fecha_inicio = '';
        $this->hora_inicio = '';
        $this->hora_fin = '';
        $this->capacidad = '';
        $this->lugar = '';
        $this->busq = '';
    }

    public function updateArea()
    {
        $this->validateInputs();
        $this->confirmingSaveDetails = true;
    }

    public function edit($id)
    {
        $coursedetail = CourseDetail::join('courses', 'courses.id', 'course_details.course_id')
                                      ->join('periods', 'periods.id', 'course_details.period_id')
                                      ->select('course_details.id','course_details.group_id',
                                                'course_details.hora_inicio','course_details.hora_fin',
                                                'course_details.capacidad','course_details.lugar',
                                                'courses.nombre as curso', 'periods.fecha_inicio')
                                      ->where('course_details.id', '=', $id)
                                      ->first();
        $this->coursedetail_id = $id;
        $this->grupo_id = $coursedetail->group_id;
        $this->curso = $coursedetail->curso;
        $this->fecha_inicio = $coursedetail->fecha_inicio;
        $this->hora_inicio = $coursedetail->hora_inicio;
        $this->hora_fin = $coursedetail->hora_fin;
        $this->capacidad = $coursedetail->capacidad;
        $this->lugar = $coursedetail->lugar;
        $this->edit = true;
        $this->create = false;
        $this->openModal();
    }

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
            'busqueda'=>$this->listaBuscador(),
        ]);
    }
    public function listaBuscador(){
        return Course::when($this->busq, fn ($query, $b) => $query
        ->where('courses.nombre', 'like', "%$b%"))
        ->get()
        ;
    }
}
