<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithFilters;
use App\Http\Traits\WithSearching;
use App\Http\Traits\WithSorting;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ConstanciasController extends Component
{
    use WithFilters;
    use WithPagination;
    use WithSearching;
    use WithSorting;

    public $perPage = '5';
    // public $search = '';
    public array $cleanStringsExcept = ['search'];
    public array $classification = [
        'curso' => '',
        'periodo' => '',
    ];
    public array $filters = [
        'grupo' => '',
        'departamento' => '',
        'filtro_calificacion' => '',
    ];

    public $queryString = [
        'perPage' => ['except' => 5, 'as' => 'p'],
    ];

    public function mostrar($periodo, $curso)
    {
        return  User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
        ->join('areas', 'areas.id', '=', 'users.area_id')
        ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
        ->join('courses', 'courses.id', '=', 'course_details.course_id')
        ->join('groups', 'groups.id', '=', 'course_details.group_id')
        ->join('periods', 'periods.id', '=', 'course_details.period_id')
        ->where('inscriptions.estatus_participante', '=', 'Participante')
        ->where('course_details.period_id', '=', $periodo)
        ->where('course_details.course_id', '=', $curso)
        ->select(['inscriptions.id','users.name','users.apellido_paterno','users.apellido_materno',DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"),'courses.nombre as curso','groups.nombre as grupo','inscriptions.calificacion','areas.nombre as area'])
        ->when($this->search, fn ($query, $search) => $query->where(DB::raw("concat(users.name,' ',users.apellido_paterno,
         ' ', users.apellido_materno)"), 'like', "%$search%"))
        ->when($this->filters['grupo'], fn ($query, $grupo) => $query->where('course_details.group_id', '=', $grupo))
        ->when($this->filters['departamento'], fn ($query, $depto) => $query->where('users.area_id', '=', $depto))
        ->when($this->filters['filtro_calificacion'], function ($query) {
            return $query->where(function ($q) {
                if ($this->filters['filtro_calificacion'] == 69) {
                    $q->where('inscriptions.calificacion', '>', 69);
                } elseif ($this->filters['filtro_calificacion'] == 70) {
                    $q->where('inscriptions.calificacion', '<', 70);
                }
            });
        })
        ->orderBy($this->sortField, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.admin.constancias.index', [
            'calificaciones'=>$this->mostrar($this->classification['periodo'], $this->classification['curso'])
            ->paginate($this->perPage),
        ]);
        // $this->resetFilters();
    }

    public function resetFilters2()
    {
        $this->reset('filters');
    }

    public function descargarConstancia($id)
    {
        $consulta = User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->join('areas', 'areas.id', '=', 'users.area_id')
            ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->where('inscriptions.estatus_participante', '=', 'Participante')
            ->where('course_details.period_id', '=', $this->classification['periodo'])
            ->where('course_details.course_id', '=', $this->classification['curso'])
            ->select(['inscriptions.id', 'users.name', 'users.apellido_paterno', 'users.apellido_materno',
                DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"),
                'courses.nombre as curso', 'groups.nombre as grupo', 'inscriptions.calificacion', 'areas.nombre as area'])
            ->where('inscriptions.id', '=', $id)->get();

        // return dd("Nombre: {$consulta->first()->nombre}, Curso: {$consulta->first()->curso}, Grupo: {$consulta->first()->grupo}, Calificación: {$consulta->first()->calificacion}");
        return dd($consulta->first());
    }

    public function descargarConstanciasZIP()
    {
        $consulta = User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->join('areas', 'areas.id', '=', 'users.area_id')
            ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->where('inscriptions.estatus_participante', '=', 'Participante')
            ->where('course_details.period_id', '=', $this->classification['periodo'])
            ->where('course_details.course_id', '=', $this->classification['curso'])
            ->select(['inscriptions.id', 'users.name', 'users.apellido_paterno', 'users.apellido_materno',
                DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"),
                'courses.nombre as curso', 'groups.nombre as grupo', 'inscriptions.calificacion', 'areas.nombre as area'])
            ->where('calificacion', '>=', 70)->get();

        return dd($consulta);
    }
}
