<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use App\Models\User;
use App\Models\Period;
use Livewire\Component;

class AssignedInstructorController extends Component
{


    protected array $cleanStringsExcept = ['search'];
    public $datos = '';
    public $lugar = '';
    public $horai;
    public $horaf;
    public $id_instructor;
    public int $perPage = 5;
    public array $classification = [
        'curso' => '',
        'periodo' => '',
        'grupo' => '',
    ];
    public $id_detalle_curso;

    protected $listeners = [
        'data_send',
        'per_send',
        'user_send',
    ];
    public function data_send($valor){
        $this->classification['curso'] = $valor;
        $this->id_detalle_curso = $valor;
    }
    public function per_send($valor){
        $this->classification['periodo'] = $valor;
    }
    public function user_send($valor){
        $this->id_instructor = $valor;
        // dd($this->id_instructor);
    }

    public function registrar(){
        $this->user = User::find($this->id_instructor);
        $courseDetails = CourseDetail::find($this->id_detalle_curso);
        $this->user->courseDetails()->attach($courseDetails, [
            'calificacion' => 0,
            'estatus_participante' => 'Instructor',
            'asistencias_minimas' => 0,
        ]);
        $this->noti('success', 'Instructor asignado correctamente');
    }

    public $id_ins;

    public function asignar(){
        // $this->id_instructor = $this->id_ins;
        $this->registrar();
        $this->closeModal();
    }


    public function resetFilters()
    {
        $this->reset('curso');
        $this->reset('grupo');
        $this->reset('lugar');
        $this->reset('horai');
        $this->reset('horaf');
    }

    public function render()
    {
        $this->valores();
        return view('livewire.admin.assignedInstructor.index', [
            'datoscurso' => $this->consultacurso($this->classification['periodo'], $this->classification['curso'], $this->classification['grupo']),
            'datosuser' => $this->consultauser(),
            'datosTabla' => $this->consultaTabla(),
            'datosPer' => $this->consultaper(),
        ]);
    }

    public function valores()
    {
        $this->datos = $this->consultacurso($this->classification['periodo'], $this->classification['curso'], $this->classification['grupo']);
        if (count($this->datos) > 0) {
            $this->id_detalle_curso = $this->datos[0]->id;
            $this->lugar = $this->datos[0]->lugar;
            $this->horai = $this->datos[0]->hora_inicio;
            $this->horaf = $this->datos[0]->hora_fin;
        }
    }
    public function consultacurso($idp, $idc, $idg)
    {
        return CourseDetail::query()
            ->select(
                'course_details.id',
                'course_details.lugar',
                'course_details.capacidad',
                'course_details.hora_inicio',
                'course_details.hora_fin',
                'course_details.capacidad'
            )
            ->where('course_details.period_id', '=', $idp)
            ->where('course_details.course_id', '=', $idc)
            ->where('course_details.group_id', '=', $idg)
            ->get();
    }
    public function consultauser(){
        return User::all();
    }

    public function noti($icon, $txt)
    {
        $this->dispatchBrowserEvent('notify', [
            'icon' => $icon,
            'message' => $txt,
        ]);
    }

    // public $busqPer;

    public function consultaper()
    {
        return Period::all();
    }

    public $search = '';
    public function consultaTabla()
    {
        return CourseDetail::join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            // ->join('inscriptions','inscriptions.course_detail_id','=','course_details.id')
            ->when($this->search, fn ($query, $search) => $query
                ->where('courses.nombre', 'like', "%$search%")
                ->orWhere('groups.nombre', 'like', "%$search%")
                ->orWhere('course_details.lugar', 'like', "%$search%")
                )
            ->when($this->classification['periodo'], fn ($query, $search) => $query
                ->where('periods.id', '=', $search))
            ->when($this->classification['curso'], fn ($query, $search) => $query
                ->where('course_details.id', '=', $search))
            // ->where('periods.id',$this->classification['periodo'])
            // ->where('course_details.id', $this->classification['curso'])
            ->select(
                'courses.nombre as cnombre',
                'groups.nombre as gnombre',
                'course_details.lugar as lugar',
                'periods.fecha_inicio as f1',
                'periods.fecha_inicio as f2',
                'course_details.id as idcurdet',
            )
            ->get();
    }
    public $modalEdit = false;
    public $id_per;
    public function openModal($id){
        $this->id_detalle_curso = $id;
        $this->modalEdit = true;
    }
    public function closeModal(){
        $this->modalEdit = false;
    }
}
