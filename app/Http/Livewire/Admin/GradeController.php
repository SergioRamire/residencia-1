<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class GradeController extends Component
{
    use WithPagination;

    public Inscription $grade;
    public $perPage = '5';
    public $search = '';
    public $calificacion;
    public $participante;
    public $grad;
    public $curso;
    public $grupo;
    public $isOpen = false;
    public $grade_id;
    public $confirmingSaveGrade = false;

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

    private function validateInputs()
    {
        $this->validate([
            'calificacion' => ['required', 'numeric'],

        ]);
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $user = User::find($this->grade_id);
        $user->courseDetails()->sync(9, ['calificacion' => 54]);
        /*
        FALTA CODIGO
        $this->validateInputs();
        Inscription::updateOrCreate(['id' => $this->grade_id], [
            'calificacion' => $this->calificacion,
        ]);
        $this->confirmingSaveArea = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'pencil',
            'message' => 'Calificación actualizada exitosamente',
        ]);

        $this->confirmingSaveGrade = false;
        $this->closeModal(); */
    }

    public function edit($id)
    {
        $grade = User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')

                ->join('course_details','course_details.id', 'inscriptions.course_detail_id')
                ->join('courses', 'courses.id', '=', 'course_details.course_id')
                ->join('groups', 'groups.id', '=', 'course_details.group_id')
                ->where('users.id', '=', $id)

                ->select('users.id', DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno)as nombre"), 'courses.nombre as curso', 'groups.nombre as grupo','inscriptions.calificacion')
                ->first();
        $this->grade_id = $id;
        $this->participante = $grade->nombre;
        $this->curso = $grade->curso;
        $this->grupo = $grade->grupo;
        $this->calificacion = $grade->calificacion;
        $this->validateInputs();
        $this->openModal();
    }

    public function obtenerCurso()
    {
        $curso = $this->curso;
    }

    public function updateGrade()
    {
        $this->validateInputs();
        $this->confirmingSaveGrade = true;
    }

    public function render()
    {

        return view('livewire.admin.grades.index', [
            'grades' =>  User::
            join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->join('course_details','course_details.id', 'inscriptions.course_detail_id')
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('period_details','period_details.course_detail_id', '=', 'course_details.id')
            ->join('periods', 'periods.id', '=', 'period_details.period_id')
            ->where('periods.fecha_inicio', '=', "2022-06-08")
            ->where('periods.fecha_fin', '=', '2022-06-14')
            ->where('course_details.course_id', '=', 6)
            ->where('course_details.group_id', '=', 3)
            ->where('inscriptions.estatus_participante', '=', "Participante")
            ->select('users.id','users.name', 'users.apellido_paterno', 'users.apellido_materno'
                    ,'inscriptions.calificacion','courses.nombre as curso','groups.nombre as grupo',
                    'periods.fecha_inicio','periods.fecha_fin')
            ->when($this->search, function ($query, $b) {
                return $query->where(function ($q) {
                    $q->Where(DB::raw("concat(users.name,' ',users.apellido_paterno,
                      ' ', users.apellido_materno)"), 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy('users.name', 'desc')
            ->paginate($this->perPage),
        ]);
    }
}
