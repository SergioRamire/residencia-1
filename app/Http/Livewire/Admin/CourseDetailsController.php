<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithFilters;
use App\Http\Traits\WithSorting;
use App\Models\Course;
use App\Models\CourseDetail;
use Livewire\Component;
use Livewire\WithPagination;


class CourseDetailsController extends Component
{
    use WithFilters;
    use WithPagination;
    use WithSorting;

    public CourseDetail $coursedetail;
    public $perPage = '5';
    public $search = '';
    public $curso;
    public $curso_elegido;
    public $periodo_elegido;
    public $grupo_elegido;
    public $coursedetail_id;
    public $grupo_id;
    public $period;
    public $hora_inicio;
    public $hora_fin;
    public $capacidad;
    public $modalidad;
    public $lugar;
    public $busq;
    public $edit = false;
    public $create = false;

    public array $classification = [
        'curso' => '',
        'periodo' => '',
    ];
    public array $filters = [
        'curso' => '',
        'modalidad' => '',
    ];

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public $showEditCreateModal = false;
    public $confirmingDetailsDeletion = false;
    public $confirmingSaveDetails = false;
    public bool $showViewModal = false;

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
        $this->curso_elegido = '';
        $this->grupo_id = '';
        $this->period = '';
        $this->hora_inicio = '';
        $this->hora_fin = '';
        $this->capacidad = '';
        $this->modalidad = '';
        $this->lugar = '';
        $this->busq = '';
    }

    private function validateInputs()
    {
        $this->validate([
            'curso' => ['required',  'exists:courses,id'],
            'period' => ['required',  'exists:periods,id'],
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'lugar' => ['required', 'regex:/^[\pL\pM\s]+$/u'],
            'course.modalidad' => ['required', 'in:En linea,Presencial,Semi-presencial'],
            'capacidad' => ['required', 'numeric'],
            'grupo_id' => ['required',  'exists:groups,id'],
        ]);
    }


    public function updateDetails()
    {
        $this->validateInputs();
        $this->confirmingSaveDetails = true;
    }

    public function view($id)
    {
        $coursedetail = CourseDetail::join('courses', 'courses.id', 'course_details.course_id')
                                      ->join('periods', 'periods.id', 'course_details.period_id')
                                      ->join('groups', 'groups.id', 'course_details.group_id')
                                      ->select('courses.nombre as curso',
                                                'course_details.hora_inicio','course_details.hora_fin',
                                                'course_details.capacidad','course_details.lugar',
                                                'course_details.modalidad','groups.nombre as grupo',
                                                'periods.fecha_inicio as fi','periods.fecha_fin as ff')
                                      ->where('course_details.id', '=', $id)
                                      ->first();
        $this->curso_elegido = $coursedetail->curso;
        $this->grupo_elegido = $coursedetail->grupo;
        $this->periodo_elegido = $coursedetail->fi.' a '.$coursedetail->ff;
        $this->hora_inicio = $coursedetail->hora_inicio;
        $this->hora_fin = $coursedetail->hora_fin;
        $this->capacidad = $coursedetail->capacidad;
        $this->modalidad = $coursedetail->modalidad;
        $this->lugar = $coursedetail->lugar;
        $this->showViewModal = true;
    }

    public function store()
    {
        $this->validateInputs();

        CourseDetail::updateOrCreate(['id' => $this->coursedetail_id], [
            'hora_inicio'=>$this->hora_inicio,
            'hora_fin'=>$this->hora_fin,
            'lugar'=>$this->lugar,
            'capacidad'=>$this->capacidad,
            'modalidad'=>$this->modalidad,
            'course_id'=>$this->curso,
            'group_id'=>$this->grupo_id,
            'period_id'=>$this->period,
        ]);

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Detalles actualizados exitosamente' : 'Detalles creados exitosamente',
        ]);

        $this->edit = false;
        $this->create = false;
        $this->confirmingSaveDetails = false;
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $coursedetail = CourseDetail::join('courses', 'courses.id', 'course_details.course_id')
                                      ->join('periods', 'periods.id', 'course_details.period_id')
                                      ->select('course_details.id','course_details.group_id',
                                                'course_details.hora_inicio','course_details.hora_fin',
                                                'course_details.capacidad','course_details.lugar',
                                                'course_details.modalidad','courses.id as curso','periods.id as periodo')
                                      ->where('course_details.id', '=', $id)
                                      ->first();
        $this->coursedetail_id = $id;
        $this->grupo_id = $coursedetail->group_id;
        $this->curso = $coursedetail->curso;
        $this->period = $coursedetail->periodo;
        $this->hora_inicio = $coursedetail->hora_inicio;
        $this->hora_fin = $coursedetail->hora_fin;
        $this->capacidad = $coursedetail->capacidad;
        $this->modalidad = $coursedetail->modalidad;
        $this->lugar = $coursedetail->lugar;
        $this->edit = true;
        $this->create = false;
        $this->openModal();
    }
    public function deleteDetails($id)
    {
        $this->coursedetail = CourseDetail::findOrFail($id);
        $course=CourseDetail::join('courses','courses.id','course_details.course_id')
                    ->select('courses.nombre as curso')
                    ->where('course_details.id','=',$id)
                    ->first();
        $this->curso_elegido=$course->curso;
        $this->confirmingDetailsDeletion = true;
    }

    public function delete()
    {
        $this->coursedetail->delete();

        $this->confirmingDetailsDeletion= false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Los detalles se han eliminado exitosamente',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.coursedetails.index', [
            'detalles'=>CourseDetail::join('courses', 'courses.id', 'course_details.course_id')
                ->join('groups', 'groups.id', 'course_details.group_id')
                ->join('periods', 'periods.id', 'course_details.period_id')
                ->where('periods.id','=',$this->classification['periodo'])
                // ->where('course_details.course_id','=',$this->classification['curso'])
                ->select('course_details.id', 'course_details.lugar', 'course_details.capacidad',
                'course_details.hora_inicio', 'course_details.hora_fin', 'courses.nombre as curso',
                'groups.nombre as grupo', 'periods.fecha_inicio', 'periods.fecha_fin')
                ->when($this->filters['curso'], fn ($query, $curso) => $query->where('course_details.course_id', '=', $curso))
                ->when($this->filters['modalidad'], fn ($query, $modalidad) => $query->where('course_details.modalidad', $modalidad))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
            'busqueda'=>$this->listaBuscador(),
        ]);
    }
    public function listaBuscador(){
        return Course::when($this->busq, fn ($query, $b) => $query
        ->where('courses.nombre', 'like', "%$b%"))
        ->get();
    }
}
