<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;


class StudyingController extends Component
{
    public $user;
    public $estatus = 'Participante';/* Participante */ /* Instructor */
    public function mount(){
        $this->user = auth()->user();
        // $this->estatus = User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
        // ->where("users.id", $this->user->id)
        // ->select('inscriptions.estatus_participante as est')
        // ->get();
        // $this->estatus = $this->estatus[0]->est;
    }
    public function render()
    {
        return view('livewire.admin.studying.index', [
            'datos' => $this->consulta(),
        ]);
    }
    public function consulta()
    {
        return CourseDetail::join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('inscriptions', 'inscriptions.course_detail_id', '=', 'course_details.id')
            ->join('users', 'users.id', '=', 'inscriptions.user_id')
            // ->when($this->classification['periodo'], fn ($query, $search) => $query
            //     ->where('periods.id', '=', $search))
            ->select(
                'courses.clave as curso_clave',
                'courses.nombre as curso_nombre',
                'groups.nombre as nombre_grupo',
                //
                'inscriptions.calificacion as califi',
                'periods.fecha_inicio as f1',
                'periods.fecha_fin as f2',
                'course_details.hora_inicio as h1',
                'course_details.hora_fin as h2',
                'course_details.lugar',
                'users.id as iduser',
                'course_details.id as idcurso'
            )
            ->where("users.id", $this->user->id)
            ->where("inscriptions.estatus_participante", $this->estatus)
            ->get();;
    }

    public function consultapdf($iduser,$idcurso)
    {
        return CourseDetail::join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('inscriptions', 'inscriptions.course_detail_id', '=', 'course_details.id')
            ->join('users', 'users.id', '=', 'inscriptions.user_id')
            ->join('areas','areas.id', '=', 'users.area_id')
            ->select(
                'courses.clave as curso_clave',
                'courses.nombre as curso_nombre',
                'periods.fecha_inicio as f1',
                'periods.fecha_fin as f2',
                'course_details.hora_inicio as h1',
                'course_details.hora_fin as h2',
                'course_details.modalidad as modalidad',
                'courses.duracion as duracion',
                'users.id as iduser', DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"),'users.name as name','users.apellido_paterno as app','users.apellido_materno as apm','users.sexo as sexo','users.rfc as rfc','users.curp as curp','users.email as correo','users.estudio_maximo as estudio_maximo','users.carrera as carrera','users.clave_presupuestal as clave_presupuestal','users.puesto_en_area as puesto','users.jefe_inmediato as jefe','users.hora_entrada as hora_entrada','users.hora_salida as hora_salida',
                'areas.nombre as nombre_area','areas.telefono as telefono','areas.extension as extension'
            )
            ->where("users.id", $iduser)
            ->where('course_details.id', $idcurso)
            ->where("inscriptions.estatus_participante", $this->estatus)
            ->get();;
    }

    public function consultains($idcurso)
    {
        return CourseDetail::join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('inscriptions', 'inscriptions.course_detail_id', '=', 'course_details.id')
            ->join('users', 'users.id', '=', 'inscriptions.user_id')
            ->select('users.id as iduser', DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"))
            ->where('course_details.id', $idcurso)
            ->where("inscriptions.estatus_participante", 'Instructor')
            ->get();;
    }

    public function downloadPdf($iduser,$idcurso){
        $coursesdetails = $this->consultapdf($iduser, $idcurso);
        $instructor = $this->consultains( $idcurso);
        $fechaini = $this->convertirfecha2($coursesdetails[0]->f1);
        $fechafin = $this->convertirfecha($coursesdetails[0]->f2);

        $pdf = Pdf::loadView('livewire.admin.studying.download_cedula', ['courses' => $coursesdetails,'ins'=>$instructor,'fecha_i'=> $fechaini,'fecha_f'=> $fechafin]);
        $pdf_file = storage_path('app/')."Cedula de Inscipcion.pdf";
        $pdf->setPaper("A4",'landscape');
        $pdf->save($pdf_file);
        return response()->download($pdf_file)->deleteFileAfterSend();
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
