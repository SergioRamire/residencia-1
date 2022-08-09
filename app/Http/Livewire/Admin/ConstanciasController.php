<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithFilters;
use App\Http\Traits\WithSearching;
use App\Http\Traits\WithSorting;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ConstanciasController extends Component
{
    use WithFilters;
    use WithPagination;
    use WithSearching;
    use WithSorting;

    public array $classification = [
        'curso' => '',
        'periodo' => '',
    ];

    public $arreglo=[];

    public $perPage = '8';
    public array $cleanStringsExcept = ['search'];
    public array $filters = [
        'grupo' => '',
        'departamento' => '',
        'filtro_calificacion' => '',
    ];

    public $queryString = [
        'perPage' => ['except' => 8, 'as' => 'p'],
    ];

    public function render()
    {
        $buscar=$this->search;
        return view('livewire.admin.constancias.index_participant', [
            'calificaciones' => $this->consultaBase()
                ->select(['inscriptions.id', 'users.id as iduser','users.name', 'users.apellido_paterno', 'users.apellido_materno', DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"),
                'courses.nombre as curso', 'groups.nombre as grupo',
                'inscriptions.calificacion','inscriptions.estatus_participante','inscriptions.asistencias_minimas', 'areas.nombre as area'])
                ->where('inscriptions.estatus_participante','=','Participante')
                ->where(function ($query) use ($buscar) {
                    $query->where(DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno)"), 'like', '%'.$buscar.'%')
                          ->orWhere('courses.nombre', 'like', '%'.$buscar.'%')
                          ->orWhere('users.name', 'like', '%'.$buscar.'%')
                          ->orWhere('users.apellido_materno', 'like', '%'.$buscar.'%')
                          ->orWhere('users.apellido_paterno', 'like', '%'.$buscar.'%')
                          ->orWhere('inscriptions.calificacion', 'like', '%'.$buscar.'%')
                          ->orWhere('groups.nombre', 'like', '%'.$buscar.'%');
                })
                ->when($this->filters['grupo'], fn ($query, $grupo) => $query->where('course_details.group_id', '=', $grupo))
                ->when($this->filters['departamento'], fn ($query, $depto) => $query->where('users.area_id', '=', $depto))
                ->when($this->filters['filtro_calificacion'], function ($query) {
                    return $query->where(function ($q) {
                        if ($this->filters['filtro_calificacion'] == 70) {
                            $q->where('inscriptions.calificacion', '>', 69);
                            $q->where('inscriptions.asistencias_minimas', '=', 1);
                            // $q->where('inscriptions.calificacion', '>', 69);
                        } elseif ($this->filters['filtro_calificacion'] == 69) {
                            $q->where('inscriptions.asistencias_minimas', '=', 0);
                            $q->orwhere('inscriptions.calificacion', '<', 70);
                        }
                    });
                })
                // ->orderBy($this->sortField, $this->sortDirection)
                ->orderBy('users.apellido_paterno', 'ASC')
                ->paginate($this->perPage),
        ]);
    }

    public function resetFilters2()
    {
        $this->reset('filters');
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
    public function obtenernumlist($iduser){
        $i=1;
        $numlist='';
        $num=0;
        $aux=$this->consultaBase()
                ->orderBy('apellido_paterno', 'ASC')->get();

        foreach($aux as $a){
            if($a->iduser == $iduser){
                $num=$i;
                break;
            }
            $i++;
        }
        if(strlen($num) < 2){
            $numlist = "00"."".$num;
        }elseif(strlen($num) < 3){
            $numlist = "0"."".$num;
        }elseif(strlen($num) == 3){
            $numlist ="".$num;
        }
        return $numlist;
    }

    public function descargarConstancia($id, $iduser)
    {
        $numlista=$this->obtenernumlist($iduser);

        $datos = $this->consultaBase()
            ->where('inscriptions.id', '=', $id)
            ->get()->first();
        list($fecha_inicial, $fecha_final, $dia_actual) = $this->get_dates($datos);

        $pdf = Pdf::loadView('livewire.admin.constancias.download_participant', ['datos' => $datos, 'fi'=> $fecha_inicial, 'ff'=> $fecha_final, 'day'=> $dia_actual, 'numlist'=> $numlista]);
        $pdf_file = storage_path('app/')."Constancia - $datos->nombre - $datos->curso - $datos->grupo.pdf";
        $pdf->save($pdf_file);

        return response()->download($pdf_file)->deleteFileAfterSend();
    }

    public function descargar_constancias_zip()
    {
        $consulta = $this->consultaBase()
            ->where('calificacion', '>=', 70)
            ->where('asistencias_minimas', '=', 1)->get();


        \Storage::makeDirectory('pdf');

        foreach ($consulta as $item) {
            list($fecha_inicial, $fecha_final, $dia_actual) = $this->getDates($item);
            $numlista=$this->obtenernumlist($item->iduser);

            $pdf = Pdf::loadView('livewire.admin.constancias.download_participant', ['datos' => $item, 'fi'=> $fecha_inicial, 'ff'=> $fecha_final, 'day'=> $dia_actual, 'numlist'=> $numlista]);
            $pdf->save(storage_path('app/pdf/')."Constancia - $item->nombre - $item->curso - $item->grupo.pdf");
        }

        /* Comprimir archivos */
        $zip = new \ZipArchive();
        $zipFile = storage_path('app/').'constancias.zip';
        $zip->open($zipFile, \ZipArchive::CREATE);

        $files = \File::files(storage_path('app/pdf'));
        foreach ($files as $file) {
            $relativeName = $file->getBasename();
            $zip->addFile($file, $relativeName);
        }
        $zip->close();

        \Storage::deleteDirectory('pdf');

        return response()->download($zipFile)->deleteFileAfterSend();
    }

    private function consultaBase()
    {
        return User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->join('areas', 'areas.id', '=', 'users.area_id')
            ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->where('inscriptions.estatus_participante', '=', 'Participante')
            ->where('course_details.period_id', '=', $this->classification['periodo'])
            ->where('course_details.course_id', '=', $this->classification['curso'])
            ->select(['inscriptions.id', 'users.id as iduser', DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"),'users.name', 'users.apellido_paterno', 'users.apellido_materno',
                'courses.nombre as curso', 'groups.nombre as grupo', 'inscriptions.calificacion','inscriptions.asistencias_minimas', 'areas.nombre as area','periods.fecha_inicio as fi', 'periods.fecha_fin as ff','courses.duracion as duracion','course_details.numero_curso']);
    }

    private function get_dates(?User $datos): array
    {
        $fechaini = Carbon::parse($datos->fi)->isoFormat('D \d\e MMMM');
        $fecha_fin = Carbon::parse($datos->ff)->isoFormat('D \d\e MMMM \d\e YYYY');
        $dia_actual = Carbon::now()->isoFormat('D \d\e MMMM \d\e YYYY');
        return [$fechaini, $fecha_fin, $dia_actual];
    }
}
