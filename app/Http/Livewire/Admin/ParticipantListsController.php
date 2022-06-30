<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithFilters;
use App\Http\Traits\WithSearching;
use App\Http\Traits\WithSorting;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;

// use App\UserExport;
// use Maatwebsite\Excel\Concerns\FromView;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Invoice;

class ParticipantListsController extends Component
{
    use WithFilters;
    use WithPagination;
    use WithSearching;
    use WithSorting;

    public $perPage = '5';
    // public $search = '';
    protected array $cleanStringsExcept = ['search'];
    public array $classification = [
        'curso' => '',
        'periodo' => '',
    ];
    public array $filters = [
        'grupo' => '',
        'departamento' => '',
    ];
    public bool $consulta = false;
    public $peri;
    // public $grupo;
    public $curso;
    // public $periodo;
    protected $queryString = [
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
        ->select('inscriptions.id',DB::raw("concat(users.name,' ',users.apellido_paterno,
        ' ', users.apellido_materno) as nombre"),'users.name','users.apellido_paterno','users.apellido_materno'
         ,'courses.nombre as curso','groups.nombre as grupo',
         'areas.nombre as area', 'periods.fecha_inicio', 'periods.fecha_fin')
        //  ->when($curso, fn ($query, $search) => $query->where('courses.id', $search))
         ->when($this->filters['grupo'], fn ($query, $grupo) => $query->where('course_details.group_id', '=', $grupo))
         ->when($this->filters['departamento'], fn ($query, $depto) => $query->where('users.area_id', '=', $depto))
         ->when($this->search, fn ($query, $search) => $query->where(DB::raw("concat(users.name,' ',users.apellido_paterno,
         ' ', users.apellido_materno)"), 'like', "%$search%")
            ->orWhere('areas.nombre', 'like', '%'.$this->search.'%')
            ->orWhere('courses.nombre', 'like', '%'.$this->search.'%')
            ->orWhere('groups.nombre', 'like', '%'.$this->search.'%'))
         ->orderBy($this->sortField, $this->sortDirection);
    }

    public function consultar()
    {
        $this->consulta = true;
    }

    public function render()
    {
        return view('livewire.admin.lists.index', [
            'lists'=>$this->mostrar($this->classification['periodo'], $this->classification['curso'])
            ->paginate($this->perPage),
        ]);
        $this->resetFilters();
    }


    protected $listeners = [
        'per_send',
        'data_send',
    ];
    public function per_send($valor){
        $this->classification['periodo'] = $valor;
    }
    public function data_send($valor){
        $this->classification['curso'] = $valor;
    }
    public function descarga(){
        $data=$this->participants($this->classification['periodo'], $this->classification['curso'],'Participante');
        $ins=$this->participants($this->classification['periodo'], $this->classification['curso'],'Instructor');
        return Excel::download(new UserExport($data, $ins), 'Lista_Asistencia.xlsx');
    }

    public function participants($periodo, $curso, $user)
    {
        return  User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
        ->join('areas', 'areas.id', '=', 'users.area_id')
        ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
        ->join('courses', 'courses.id', '=', 'course_details.course_id')
        ->join('groups', 'groups.id', '=', 'course_details.group_id')
        ->join('periods', 'periods.id', '=', 'course_details.period_id')
        ->where('inscriptions.estatus_participante', '=', $user)
        ->where('course_details.period_id', '=', $periodo)
        ->where('course_details.course_id', '=', $curso)
        ->select('inscriptions.id',DB::raw("concat(users.name,' ',users.apellido_paterno,
        ' ', users.apellido_materno) as nombre"),'users.name as name','users.apellido_paterno as app','users.apellido_materno as apm','users.rfc as rfc','users.sexo as sex','courses.clave as clave','courses.duracion as duracion'
         ,'courses.nombre as curso','groups.nombre as grupo','course_details.modalidad as modalidad',
        'areas.nombre as area', 'periods.fecha_inicio as fi', 'periods.fecha_fin as ff','course_details.hora_inicio as hi','course_details.hora_fin as hf')->get();
    }
}
