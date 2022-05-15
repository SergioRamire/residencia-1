<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coursesdetail;
use App\Models\Group;
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
    public $curso = 'Quis qui quos quo.';
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
        /* $this->validateInputs();
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
        /* $grade = Inscription::join('users', 'users.id', '=', 'user_id')
                ->join('coursesdetails', 'coursesdetails.id', '=', 'inscriptions.coursesdetail_id')
                ->join('courses', 'courses.id', '=', 'coursesdetails.course_id')
                ->where('inscriptions.id', '=', $id)
                ->select('inscriptions.id', DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno)as nombre"), 'courses.nombre as curso', 'inscriptions.calificacion')
                ->first();
        $this->grade_id = $id;
        $this->participante = $grade->nombre;
        $this->curso = $grade->curso;
        $this->calificacion = $grade->calificacion;
        $this->validateInputs();
        $this->openModal(); */
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

    public function miFuncion()
    {
        // id de sala
        $id_sala = $request->get('id');
        // instancia sala
        $this->grad = inscrition::with('users')->find(3);

        return  $this->grad;
    }

    public function render()
    {
        $grads = User::find(1)->courseDetails->pivot->where('calificacion', 44)->get();

        return view('livewire.admin.grades.index', [
            'grads',
        ]);
    }
}
