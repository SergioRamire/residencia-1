<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class VerConstanciasFirmadasController extends Component
{
    public function descargar_constancia_firmada(string $url_cedula)
    {
        $disk_path = config('filesystems.disks.public.root');
        return response()->download("$disk_path/$url_cedula");
    }

    public function ver_constancia_firmada(string $url_cedula)
    {
        return redirect("storage/$url_cedula");
    }

    public function constancias_firmadas()
    {
        return User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->join('course_details', 'course_details.id', '=', 'inscriptions.course_detail_id')
            ->join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
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
                'users.name as nombre', 'users.apellido_paterno', 'users.apellido_materno',
                'inscriptions.url_cedula',
            ])
            ->where('url_cedula', '!=', '')
            ->where('url_cedula', '!=', null)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.verConstanciaFirmada.index', [
            'constancias' => $this->constancias_firmadas(),
        ]);
    }
}
