<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSearching;
use App\Models\CourseDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ConstanciasController extends Component
{
    use WithPagination;
    use WithSearching;

    //variables de busqueda y paginacion
    public $perPage = 8;
    protected array $cleanStringsExcept = ['search'];

    //variable filtro de curso
    public $filters = [
        'filtro_curso' => '',
        'filtro_calificacion'=>'',
        'fecha_inicio' => '',
        'fecha_fin' => '',
    ];


    protected $queryString = [
        'perPage' => ['except' => 8, 'as' => 'p'],
    ];

    public function render()
    {
        return view('livewire.admin.constancias.index', [
            'calificaciones' =>  CourseDetail::query()
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('inscriptions', 'inscriptions.course_detail_id', '=', 'course_details.id')
            ->join('users', 'users.id', '=', 'inscriptions.user_id')
            ->join('period_details','period_details.course_detail_id', '=', 'course_details.id')
            ->join('periods', 'periods.id', '=', 'period_details.period_id')
            ->select('users.name', 'users.apellido_paterno', 'users.apellido_materno', 'courses.nombre as curso', 'inscriptions.calificacion', 'inscriptions.estatus_participante', 'course_details.id')
            ->where('inscriptions.estatus_participante', '=', 'Participante')
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

}
