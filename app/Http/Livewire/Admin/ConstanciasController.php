<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithFilters;
use App\Http\Traits\WithSearching;
use App\Http\Traits\WithSorting;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public $perPage = '5';
    public array $cleanStringsExcept = ['search'];
    public array $filters = [
        'grupo' => '',
        'departamento' => '',
        'filtro_calificacion' => '',
    ];

    public $queryString = [
        'perPage' => ['except' => 5, 'as' => 'p'],
    ];

    public function render()
    {
        return view('livewire.admin.constancias.index', [
            'calificaciones' => $this->consultaBase()
                ->select(['inscriptions.id', 'users.name', 'users.apellido_paterno', 'users.apellido_materno', DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"), 'courses.nombre as curso', 'groups.nombre as grupo', 'inscriptions.calificacion', 'areas.nombre as area'])
                ->when($this->search, fn ($query, $search) => $query->where(DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno)"), 'like', "%$search%"))
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
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }

    public function resetFilters2()
    {
        $this->reset('filters');
    }

    public function descargarConstancia($id, $periodo, $curso)
    {
        $datos = $this->consultaBase($periodo, $curso)
            ->where('inscriptions.id', '=', $id)
            ->get()->first();
        $pdf = Pdf::loadView('livewire.admin.constancias.descarga', ['datos' => $datos]);

        return $pdf->download('Constancia.pdf');

    }

    public function descargarConstanciasZIP()
    {
        $consulta = $this->consultaBase()
            ->where('calificacion', '>=', 70)
            ->get();

        \Storage::makeDirectory('pdf');

        foreach ($consulta as $item) {
            $pdf = Pdf::loadView('livewire.admin.constancias.descarga', ['datos' => $item]);
            $pdf->save(storage_path('app/pdf')."/Constancia - $item->nombre - $item->curso - $item->grupo.pdf");
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

    private function consultaBase($periodo = null, $curso = null)
    {
        return User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->join('areas', 'areas.id', '=', 'users.area_id')
            ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->where('inscriptions.estatus_participante', '=', 'Participante')
            ->where('course_details.period_id', '=', $periodo ?? $this->classification['periodo'])
            ->where('course_details.course_id', '=', $curso ?? $this->classification['curso'])
            ->select(['inscriptions.id', 'users.name', 'users.apellido_paterno', 'users.apellido_materno',
                DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"),
                'courses.nombre as curso', 'groups.nombre as grupo', 'inscriptions.calificacion', 'areas.nombre as area']);
    }
}
