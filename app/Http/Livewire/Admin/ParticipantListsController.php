<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use App\Models\User;
use App\Http\Traits\WithFilters;
use App\Http\Traits\WithSearching;
use App\Http\Traits\WithSorting;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipantListsController extends Component
{
    use WithFilters;
    use WithPagination;
    use WithSearching;
    use WithSorting;

    public $perPage = '5';
    // public $search = '';
    protected array $cleanStringsExcept = ['search'];
    public array $filters = [
        'grupo' => '',
        'curso' => '',
        'periodo' => '',
    ];
    // public $peri;
    // public $grupo;
    // public $curso;
    // public $periodo;
    protected $queryString = [
        'perPage' => ['except' => 5, 'as' => 'p'],
    ];

    public function mostrar(){
        return  User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
        ->join('areas', 'areas.id', '=', 'users.area_id')
        ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
        ->join('courses', 'courses.id', '=', 'course_details.course_id')
        ->join('groups', 'groups.id', '=', 'course_details.group_id')
        ->join('periods', 'periods.id', '=', 'course_details.period_id')
        ->where('inscriptions.estatus_participante', '=', 'Participante')

        ->select('users.id',DB::raw("concat(users.name,' ',users.apellido_paterno,
        ' ', users.apellido_materno) as nombre"),'users.name','users.apellido_paterno','users.apellido_materno'
         ,'courses.nombre as curso','groups.nombre as grupo',
         'areas.nombre as area','periods.fecha_inicio', 'periods.fecha_fin')
         // ->distinct()
         ->when($this->filters['periodo'], fn ($query, $periodo)
             => $query->where('course_details.period_id','=' ,$periodo))
         ->when($this->filters['grupo'], fn ($query, $grupo)
             => $query->where('course_details.group_id','=' ,$grupo))
         ->when($this->filters['curso'], fn ($query, $curso)
             => $query->where('course_details.course_id','=' ,$curso))
         ->when($this->search, fn ($query, $search) => $query->where(DB::raw("concat(users.name,' ',users.apellido_paterno,
         ' ', users.apellido_materno)"), 'like', "%$search%"))
         ->orderBy($this->sortField, $this->sortDirection);
    }
    public function render()
    {

        return view('livewire.admin.lists.index', [
            'lists' => $this->mostrar()
                        ->paginate($this->perPage),

        ]);
        $this->resetFilters();
    }
}
