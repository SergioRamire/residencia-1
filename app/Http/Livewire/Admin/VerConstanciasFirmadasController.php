<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\WithFilters;
use App\Http\Traits\WithSearching;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;

class VerConstanciasFirmadasController extends Component
{
    use WithFilters;
    use WithPagination;
    use WithSearching;
    use WithSorting;

    public $perPage = '8';

    protected array $cleanStringsExcept = ['search'];

    protected $queryString = [
        'perPage' => ['except' => 8, 'as' => 'p'],
    ];

    public $id_periodo;
    public $id_curso;

    public function descargar_constancia_firmada(string $url_cedula)
    {
        $disk_path = config('filesystems.disks.public.root');
        return response()->download("$disk_path/$url_cedula");
    }

    // public function ver_constancia_firmada(string $url_cedula)
    // {
    //     return redirect("storage/$url_cedula");
    // }

    public function constancias_firmadas()
    {
        $buscar = $this->search;
        return User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->join('course_details', 'course_details.id', '=', 'inscriptions.course_detail_id')
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->where('course_details.period_id', '=', $this->id_periodo)
            ->where('course_details.course_id', '=', $this->id_curso)
            ->where('url_cedula', '!=', '')
            ->where('url_cedula', '!=', null)
            ->select([
                'courses.clave as curso_clave',
                'courses.nombre as curso_nombre',
                'groups.nombre as grupo_nombre',
                'inscriptions.estatus_participante',
                'periods.clave as periodo_clave',
                'periods.fecha_inicio',
                'periods.fecha_fin',
                'course_details.hora_inicio',
                'course_details.hora_fin',
                DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"),
                'users.name as nombre', 'users.apellido_paterno', 'users.apellido_materno',
                'inscriptions.url_cedula',
            ])
            ->where(function ($query) use ($buscar) {
                $query->where(DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno)"), 'like', '%'.$buscar.'%')
                      ->orWhere('courses.nombre', 'like', '%'.$buscar.'%')
                      ->orWhere('users.name', 'like', '%'.$buscar.'%')
                      ->orWhere('users.apellido_materno', 'like', '%'.$buscar.'%')
                      ->orWhere('users.apellido_paterno', 'like', '%'.$buscar.'%')
                      ->orWhere('groups.nombre', 'like', '%'.$buscar.'%');
            })
            ->paginate($this->perPage);
            // ->get();
            $this->resetFilters();
    }

    public function render()
    {
        return view('livewire.admin.verConstanciaFirmada.index', [
            'constancias' => $this->constancias_firmadas(),
        ]);
    }

    protected $listeners = [
        'per_send',
        'data_send',
    ];

    public function per_send($valor){
        $this->id_periodo = $valor;
    }
    public function data_send($valor){
        $this->id_curso = $valor;
    }

}
