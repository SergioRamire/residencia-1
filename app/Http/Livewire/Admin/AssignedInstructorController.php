<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use App\Models\User;
use App\Models\Period;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AssignedInstructorController extends Component
{

    use WithPagination;

    protected array $cleanStringsExcept = ['search'];
    public $datos = '';
    public $lugar = '';
    public $horai;
    public $horaf;
    public $id_instructor;

    public int $perPage = 8;
    protected $queryString = [
        'perPage' => ['except' => 8, 'as' => 'p'],
    ];

    public array $classification = [
        'curso' => '',
        'periodo' => '',
        'grupo' => '',
    ];
    public $id_detalle_curso;

    protected $listeners = [
        'per_send',
        'data_send',
        'user_send',
    ];
    public function per_send($valor){
        $this->classification['periodo'] = $valor;
    }
    public function data_send($valor){
        $this->classification['curso'] = $valor;
        $this->id_detalle_curso = $valor;
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
        $this->modalConfirmacion = false;
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
            'datosTabla' => $this->consultaTabla()->paginate($this->perPage),
            'datosPer' => $this->consultaper(),
            'listaIns' => $this->consultaDocentes(),
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
            ->get()
            ;
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
    public function consultaTabla(){
        return CourseDetail::join('courses', 'courses.id', '=', 'course_details.course_id')
            ->join('periods', 'periods.id', '=', 'course_details.period_id')
            ->join('groups', 'groups.id', '=', 'course_details.group_id')
            ->join('inscriptions','inscriptions.course_detail_id','course_details.id')
            ->where('inscriptions.estatus_participante','like','Instructor')
            ->when($this->search, fn ($query, $search) => $query
                ->where('courses.nombre', 'like', "%$search%")
                ->orWhere('groups.nombre', 'like', "%$search%")
                ->orWhere('course_details.lugar', 'like', "%$search%")
                ->orWhere('course_details.hora_inicio', 'like', "%$search%")
                ->orWhere('course_details.hora_fin', 'like', "%$search%")
                )
            // ->when($this->classification['periodo'], fn ($query, $search) => $query
            //     ->where('periods.id', '=', $search))
            // ->when($this->classification['curso'], fn ($query, $search) => $query
            //     ->where('courses.id', '=', $search))
            ->where('periods.id',$this->classification['periodo'])
            ->where('courses.id', $this->classification['curso'])
            ->select(
                'courses.nombre as cnombre',
                'groups.nombre as gnombre',
                'course_details.lugar as lugar',
                'periods.fecha_inicio as f1',
                'periods.fecha_inicio as f2',
                'course_details.id as idcurdet',
            )
            ->distinct()
            // ->get()
            ;
    }
    public $modalEdit = false;
    public $id_per;
    public $create = false;
    public $show = false;
    public $delet = false;


    public $id_detalle_curso2;

    public function openModalCreate($id){
        $this->id_detalle_curso = $id;
        $this->modalEdit = true;
        $this->create = true;
        $this->show = false;
        $this->delet = false;
    }
    public function openModalShow($id){
        $this->id_detalle_curso2 = $id;
        $this->modalEdit = true;
        $this->create = false;
        $this->show = true;
        $this->delet = false;
    }
    public function openModalDelete($id){
        $this->id_detalle_curso2 = $id;
        $this->modalEdit = true;
        $this->create = false;
        $this->show = false;
        $this->delet = true;
    }
    public function closeModal(){
        $this->modalEdit = false;
        $this->create = false;
        $this->show = false;
        $this->delet = false;
    }

    public function consultaDocentes(){
        return User::join('inscriptions','inscriptions.user_id','users.id')
        ->join('course_details','course_details.id','inscriptions.course_detail_id')
        ->where('course_details.id',$this->id_detalle_curso2)
        ->where('inscriptions.estatus_participante','like','Instructor')
        ->select('users.id as idu', 'users.name as n', 'users.apellido_paterno as ap1', 'users.apellido_materno as ap2',
            'inscriptions.id as idi',)
        ->get();
    }
    public $id_ins_delete;
    public $modaldelete = false;

    public function delete(){
        $this->modaldelete = true;
    }
    public function delete2($id){
        $this->id_ins_delete = $id;
        $this->modaldelete = true;
    }
    public function destroy()
    {
        DB::table('inscriptions')
            ->delete($this->id_ins_delete);
        $this->id_ins_delete = null;
        $this->modaldelete = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Instructor eliminado exitosamente',
        ]);
    }


    public bool $modalConfirmacion;
    public function openConfirmacion(){
        $this->modalConfirmacion = true;
    }
}
