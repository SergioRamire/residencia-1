<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use App\Http\Traits\WithFilters;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class ConstanciaInstructorController extends Component
{
    use WithFilters;
    use WithPagination;

    public $perPage = '8';
    public $search = '';

    // protected array $cleanStringsExcept = ['search'];

    //variable filtro de curso
    public array $filters = [
        'filtro_curso' => '',
        'fecha' => '',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage',
    ];

    // public function updatingFilters()
    // {
    //     $this->resetPage();
    // }

    // public function updatingSearch()
    // {
    //     $this->resetPage();
    // }

    // public function resetFilters()
    // {
    //     $this->reset('search');
    // }


    public function render()
    {
        return view('livewire.admin.constancias.index_instructor', [
            'instructor' =>  CourseDetail::query()
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('inscriptions', 'inscriptions.course_detail_id', '=', 'course_details.id')
            ->join('users', 'users.id', '=', 'inscriptions.user_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->select('users.id as iduser','users.name', 'users.apellido_paterno', 'users.apellido_materno', 'courses.nombre as curso', 'inscriptions.estatus_participante', 'periods.fecha_inicio as fi', 'periods.fecha_fin as ff','groups.nombre as nombregrupo','course_details.course_id')
            ->where('inscriptions.estatus_participante', '=', 'Instructor')
            ->when($this->search, function ($query, $b) {
                return $query->where(function ($q) {
                    $q->Where(DB::raw("concat(users.name,' ',users.apellido_paterno,
                      ' ', users.apellido_materno)"), 'like', '%'.$this->search.'%')
                      ->orWhere('courses.nombre', 'like', '%'.$this->search.'%')
                      ->orWhere('groups.nombre', 'like', '%'.$this->search.'%');
                });

            })
            ->when($this->filters['filtro_curso'], function ($query, $b) {
                return $query->where(function ($q) {
                    $q->where('courses.nombre', 'like', '%'.$this->filters['filtro_curso'].'%')
                    ->where('inscriptions.estatus_participante', '=', 'Instructor');
                });
            })
            ->where('periods.id', '=', $this->filters['fecha'])
            // ->where('course_details.course_id', '=', $this->filters['filtro_curso'])
            ->orderBy('users.name', 'asc')
            ->paginate($this->perPage),
        ]);
        // $this->resetFilters();
    }


    // public function resetFilters2()
    // {
    //     $this->reset('filters');
    // }

    protected $listeners = [
        'data_send',
        'per_send',
    ];
    public function per_send($valor){
        $this->filters['fecha']= $valor;
    }
    public function data_send($valor){
        $this->filters['filtro_curso'] = $valor;
    }


    public function descargarConstancia($id)
    {
        $datos = $this->consultaBase()
            ->where('users.id', '=', $id)
            ->get()->first();
        $fechaini = $this->convertirfecha2($datos->fi);
        $fechafin =  $this->convertirfecha($datos->ff);
        $diaactual = $this->convertirfecha(date('d-m-Y'));
        $pdf = Pdf::loadView('livewire.admin.constancias.download_instructor', ['datos' => $datos,'fi'=> $fechaini,'ff'=> $fechafin,'day'=> $diaactual]);
        $pdf_file = storage_path('app/')."Constancia-$datos->nombre-$datos->grupo.pdf";
        $pdf->save($pdf_file);

        return response()->download($pdf_file)->deleteFileAfterSend();
    }

    public function descargarConstanciasZIP()
    {
        $consulta = $this->consultaBase();

        \Storage::makeDirectory('pdf');

        foreach ($consulta as $item) {
            $fechaini = $this->convertirfecha2($item->fi);
            $fechafin =  $this->convertirfecha($item->ff);
            $diaactual = $this->convertirfecha(date('d-m-Y'));
            $pdf = Pdf::loadView('livewire.admin.constancias.descargainstructor', ['datos' => $item,'fi'=> $fechaini,'ff'=> $fechafin,'day'=> $diaactual]);
            $pdf->save(storage_path('app/pdf/')."Constancia-$item->nombre-$item->grupo.pdf");
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
            ->where('inscriptions.estatus_participante', '=', 'Instructor')
            ->where('course_details.period_id', '=', $this->filters['fecha'])
            // ->where('course_details.course_id', '=', $this->filters['filtro_curso'])
            ->select(['users.id as iduser', DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"),'users.name as name','users.apellido_paterno as app','users.apellido_materno as apm','users.sexo as sexo', 'courses.nombre as curso', 'groups.nombre as grupo', 'areas.nombre as area','periods.fecha_inicio as fi', 'periods.fecha_fin as ff','courses.duracion as duracion']);
            // ->when($this->filters['filtro_curso'], fn ($query, $filtro_curso) => $query->where('course_details.nombre', '=', $filtro_curso));
    }

    public function convertirfecha($fecha){
        setlocale(LC_TIME, "spanish");
        $newDate = date("d-m-Y", strtotime($fecha));
       return  strftime("%d de %B de %Y", strtotime($newDate));
    }

    public function convertirfecha2($fecha){
        setlocale(LC_TIME, "spanish");
        $newDate = date("d-m-Y", strtotime($fecha));
       return  strftime("%d de %B", strtotime($newDate));
    }

}
