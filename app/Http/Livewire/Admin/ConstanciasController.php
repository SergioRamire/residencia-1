<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use App\Models\Inscription;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ConstanciasController extends Component
{
    use WithPagination;

    //variables de busqueda y paginacion
    public $perPage = '5';
    public $search = '';

    //variable filtro de curso
    public $filters = [
        'filtro_curso' => '',
        'filtro_calificacion'=>'',
        'filtro_año'=>'',
    ];
    public $par='Instructor';


    protected $queryString = [
        'search' => ['except' => ''],
        'perPage',
    ];

    public function render()
    {
        $this->obtenerCursos();
        $query = '%'.$this->search.'%';

        return view('livewire.admin.constancias.index', [
            'calificaciones' =>  Inscription::join('users', 'users.id', '=', 'user_id')
            ->join('coursesdetails', 'coursesdetails.id', '=', 'inscriptions.coursesdetail_id')
            ->join('courses', 'courses.id', '=', 'coursesdetails.course_id')
            // ->join('groupassignments', 'groupassignments.coursesdetail_id', '=', 'coursesdetails.id')
            // ->join('groups', 'groups.id', '=', 'groupassignments.group_id')
            ->select('users.name', 'users.apellido_paterno', 'users.apellido_materno', 'courses.nombre as curso', 'inscriptions.calificacion', 'inscriptions.estatus', 'users.id as i','coursesdetails.id')
            ->where('inscriptions.estatus', '=', 'Participante')
            ->when($this->search, function ($query, $b) {
                return $query->where(function ($q) {
                    $q->Where(DB::raw("concat(users.name,' ',users.apellido_paterno,
                      ' ', users.apellido_materno)"), 'like', '%'.$this->search.'%')
                      ->orWhere('courses.nombre', 'like', '%'.$this->search.'%')
                      ->orWhere('inscriptions.calificacion', 'like', '%'.$this->search.'%');

                });
            })
            ->when($this->filters['filtro_curso'], function ($query, $b) {
                return $query->where(function ($q) {
                    $q->where('courses.nombre', 'like', '%'.$this->filters['filtro_curso'].'%');
                });
            })
            ->when($this->filters['filtro_calificacion'], function ($query, $b) {
                return $query->where(function ($q) {
                    if($this->filters['filtro_calificacion'] == 69)
                        $q->where('inscriptions.calificacion','>',69);
                    elseif($this->filters['filtro_calificacion'] == 70)
                       $q->where('inscriptions.calificacion','<',70);
                });
            })
            ->when($this->filters['filtro_año'], function ($query, $b) {
                return $query->where(function ($q) {
                    $q->whereYear('coursesdetails.fecha_inicio', 'like', '%'.$this->filters['filtro_año'].'%');
                });
            })
            ->orderBy('users.name', 'asc')
            ->paginate($this->perPage),
        ]);
    }

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

    public function obtenerCursos()
    {
        $this->cursos = Course::select('courses.id', 'courses.nombre')->get();
    }
}


