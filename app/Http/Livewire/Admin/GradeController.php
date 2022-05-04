<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coursesdetail;
use App\Models\Group;
use App\Models\Groupassignment;
use App\Models\Inscription;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class GradeController extends Component
{
    use WithPagination;

    public Grade $grade;
    public $perPage = '5';
    public $search = '';
    public $calificacion;
    public $participante;
    public $curso = 'Atque pariatur eveniet.';
    public $grupo = 24;
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
            'calificacion' => ['required', 'regex:/^[0-9]+$/'],

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
        $this->validateInputs();
        Grade::updateOrCreate(['id' => $this->grade_id], [
            'calificacion' => $this->calificacion,
        ]);
        $this->confirmingSaveArea = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'pencil',
            'message' => 'Calificación actualizada exitosamente',
        ]);

        $this->confirmingSaveGrade = false;
        $this->closeModal();
    }

    public function edit($id)
    {
        $grade = Grade::join('groups', 'grades.group_id', '=', 'groups.id')
                ->join('courses', 'groups.course_id', '=', 'courses.id')
                ->join('participants', 'grades.participant_id', '=', 'participants.id')
                ->where('grades.id', '=', $id)
                ->select('grades.id', DB::raw("concat(participants.nombre,' ',participants.apellido_paterno,' ', participants.apellido_materno)as nombre"), 'courses.nombre as curso', 'grades.group_id', 'grades.calificacion')

                ->first();
        // ->select('grades.id','participants.nombre as nombre','courses.nombre as curso','grades.group_id','grades.calificacion');
        $this->grade_id = $id;
        $this->participante = $grade->nombre;
        $this->curso = $grade->curso;
        $this->grupo = $grade->group_id;
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
            'grades' => Grade::join('groups', 'grades.group_id', '=', 'groups.id')
                     ->join('courses', 'groups.course_id', '=', 'courses.id')
                     ->join('participants', 'grades.participant_id', '=', 'participants.id')
                     ->where('courses.id', '=', 9)
                     ->where('groups.id', '=', 15)
                     ->select('grades.id', 'participants.nombre', 'participants.apellido_paterno', 'participants.apellido_materno', 'courses.nombre as curso', 'grades.group_id', 'grades.calificacion')
                     ->when($this->search, function ($query, $b) {
                         return $query->where(function ($q) {
                             $q->where('participants.nombre', 'like', '%'.$this->search.'%')
                               ->orWhere(DB::raw("concat(participants.nombre,' ',participants.apellido_paterno,
                               ' ', participants.apellido_materno)"), 'like', '%'.$this->search.'%');
                         });
                     })
                     ->orderBy('participants.nombre', 'asc')
                     ->paginate($this->perPage),
        ]);
    }
}
