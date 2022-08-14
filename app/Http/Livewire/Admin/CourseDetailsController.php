<?php

namespace App\Http\Livewire\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\WithFilters;
use App\Http\Traits\WithSorting;
use App\Http\Traits\WithSearching;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Group;
use App\Models\Period;
use App\Rules\Time;
use Livewire\Component;
use Livewire\WithPagination;
// use Barryvdh\DomPDF\Facades as PDF;
use Barryvdh\DomPDF\Facade\Pdf;



class CourseDetailsController extends Component
{
    use WithFilters;
    use WithPagination;
    use WithSearching;
    use WithSorting;

    public CourseDetail $coursedetail;
    public $perPage = '8';
    protected array $cleanStringsExcept = ['search'];
    public $coursedetail_id;
    public $curso_elegido;
    public $curso;
    public $periodo_elegido;
    public $grupo_elegido;
    public $grupo_id;
    public $period;
    public $hora_inicio;
    public $hora_fin;
    public $capacidad;
    public $modalidad;
    public $numero_curso;
    public $lugar;
    public $busq;
    public $edit = false;
    public $create = false;
    public $modal = false;

    public $show_edit_createModal = false;
    public $confirming_details_deletion = false;
    public $confirming_save_details = false;
    public bool $show_view_modal = false;

    protected $listeners = [
        'per_send',
        'per_send2',
        'data_send',
        'send_curso',
    ];

    public array $classification = [
        'curso' => '',
        'periodo' => '',
    ];

    public array $filters = [
        'curso' => '',
        'modalidad' => '',
    ];

    public function rules(): array
    {
        return [
            'curso' => ['required',  'exists:courses,id'],
            'period' => ['required',  'exists:periods,id'],
            'hora_inicio' => ['required', new Time('07:00:00', '17:00:00')],
            'hora_fin' => ['required', new Time('08:00:00', '18:00:00')],
            'lugar' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'modalidad' => ['required', 'in:En linea,Presencial,Semi-presencial'],
            'numero_curso'=>['required', 'numeric'],
            'capacidad' => ['required', 'numeric'],
            'grupo_id' => ['required',  'exists:groups,id'],
        ];
    }

    protected $queryString = [
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create(){
        $this->resetErrorBag();
        $this->resetInputFields();
        $this->emit('valorCurso','');
        $this->emit('valorPerio','');
        $this->open_modal();
        $this->edit = false;
        $this->create = true;
    }

    public function open_modal(){
        $this->show_edit_createModal = true;
    }

    public function close_modal(){
        $this->show_edit_createModal = false;
    }

    private function resetInputFields(){
        $this->curso = '';
        $this->curso_elegido = '';
        $this->grupo_id = '';
        $this->period = '';
        $this->hora_inicio = '';
        $this->hora_fin = '';
        $this->capacidad = '';
        $this->modalidad = '';
        $this->lugar = '';
        $this->busq = '';
        $this->numero_curso = '';
    }

    public function update_details(){
        $this->validate();
        $this->confirming_save_details = true;
    }

    public function view($id){
        $coursedetail = CourseDetail::find($id);
        // $this->curso = $coursedetail->curso;
        // $this->grupo_elegido = $coursedetail->grupo;
        // $this->periodo_elegido = $coursedetail->fi.' a '.$coursedetail->ff;
        // $this->hora_inicio = $coursedetail->hora_inicio;
        // $this->hora_fin = $coursedetail->hora_fin;
        // $this->capacidad = $coursedetail->capacidad;
        // $this->modalidad = $coursedetail->modalidad;

        $this->coursedetail_id = $id;
        // $this->grupo_id = $coursedetail->group_id;
        // $this->curso = $coursedetail->course_id;
        // $this->period = $coursedetail->period_id;
        $this->hora_inicio = $coursedetail->hora_inicio;
        $this->hora_fin = $coursedetail->hora_fin;
        $this->capacidad = $coursedetail->capacidad;
        $this->modalidad = $coursedetail->modalidad;
        $this->numero_curso = $coursedetail->numero_curso;
        $this->lugar = $coursedetail->lugar;

        $this->curso = Course::find($coursedetail->course_id)->nombre;
        $this->period = Period::find($coursedetail->period_id)->clave;
        $this->grupo_id = Group::find($coursedetail->group_id)->nombre;


        $this->lugar = $coursedetail->lugar;
        $this->show_view_modal = true;
    }

    public function store(){
        $this->validate();
        CourseDetail::updateOrCreate(['id' => $this->coursedetail_id], [
            'hora_inicio'=>$this->hora_inicio,
            'hora_fin'=>$this->hora_fin,
            'lugar'=>$this->lugar,
            'capacidad'=>$this->capacidad,
            'modalidad'=>$this->modalidad,
            'numero_curso'=>$this->numero_curso,
            'course_id'=>$this->curso,
            'group_id'=>$this->grupo_id,
            'period_id'=>$this->period,
        ]);
        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Detalles actualizados exitosamente' : 'Detalles creados exitosamente',
        ]);
        $this->edit = false;
        $this->create = false;
        $this->confirming_save_details = false;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->close_modal();
        $this->resetInputFields();
    }

    public function edit($id){
        $this->resetErrorBag();
        $this->resetInputFields();
        $coursedetail = CourseDetail::find($id);
        $this->coursedetail_id = $id;
        $this->grupo_id = $coursedetail->group_id;
        $this->curso = $coursedetail->course_id;
        $this->period = $coursedetail->period_id;
        $this->hora_inicio = $coursedetail->hora_inicio;
        $this->hora_fin = $coursedetail->hora_fin;
        $this->capacidad = $coursedetail->capacidad;
        $this->modalidad = $coursedetail->modalidad;
        $this->numero_curso= $coursedetail->numero_curso;
        $this->lugar = $coursedetail->lugar;
        $this->emit('valorCurso',$this->curso);
        $this->emit('valorPerio',$this->period);
        $this->edit = true;
        $this->create = false;
        $this->open_modal();

    }

    public function delete_details($id){
        $this->coursedetail = CourseDetail::findOrFail($id);
        $course = CourseDetail::join('courses','courses.id','course_details.course_id')
            ->select('courses.nombre as curso')
            ->where('course_details.id','=',$id)
            ->first();
        $this->curso_elegido=$course->curso;
        $this->confirming_details_deletion = true;
    }

    public function delete(){
        $this->coursedetail->delete();
        $this->confirming_details_deletion= false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Los detalles se han eliminado exitosamente',
        ]);
    }

    public function mostrar(){
        $buscar=$this->search;
        return CourseDetail::join('courses', 'courses.id', 'course_details.course_id')
        ->join('groups', 'groups.id', 'course_details.group_id')
        ->join('periods', 'periods.id', 'course_details.period_id')
        ->where('periods.id','=',$this->classification['periodo'])
        ->select('course_details.id', 'course_details.lugar', 'course_details.capacidad',
        'course_details.hora_inicio', 'course_details.hora_fin', 'courses.clave', 'courses.nombre as curso',
        'groups.nombre as grupo', 'periods.fecha_inicio', 'periods.fecha_fin')
        ->where(function ($query) use ($buscar) {
            $query->where('courses.clave', 'like', '%'.$buscar.'%')
            ->orwhere('courses.nombre', 'like', '%'.$buscar.'%')
            ->orWhere('course_details.modalidad', 'like', '%'.$buscar.'%')
            ->orWhere('periods.fecha_inicio', 'like', '%'.$buscar.'%')
            ->orWhere('periods.fecha_fin', 'like', '%'.$buscar.'%')
            ->orWhere('course_details.hora_inicio', 'like', '%'.$buscar.'%')
            ->orWhere('course_details.hora_fin', 'like', '%'.$buscar.'%')
            ->orWhere('course_details.lugar', 'like', '%'.$buscar.'%')
            ->orWhere('course_details.capacidad', 'like', '%'.$buscar.'%');
        })
        ->orderBy($this->sortField, $this->sortDirection);
    }

    public function render(){
        return view('livewire.admin.coursedetails.index', [
            'detalles'=>$this->mostrar()->paginate($this->perPage),
        ]);
    }

    public function per_send($valor){
        $this->classification['periodo'] = $valor;
    }

    public function per_send2($valor){
        $this->period = $valor;
    }

    public function data_send($valor){
        $this->classification['curso'] = $valor;
        $this->id_detalle_curso = $valor;
    }

    public function send_curso($valor){
        $this->curso = $valor;
    }

    public function download_pdf(){
        $coursesdetails = CourseDetail::join('courses', 'courses.id','=', 'course_details.course_id')
        ->join('groups', 'groups.id', '=','course_details.group_id')
        ->join('periods', 'periods.id','=', 'course_details.period_id')
        ->join('inscriptions', 'inscriptions.course_detail_id','=','course_details.id')
        ->join('users', 'users.id','=','inscriptions.user_id')
        ->where('inscriptions.estatus_participante', '=', 'Instructor')
        ->where('periods.id','=',$this->classification['periodo'])
        ->select('courses.nombre as curso','courses.objetivo as objetivo','courses.perfil as per', 'courses.duracion as duracion','course_details.lugar as lugar','courses.dirigido as dirigido','courses.observaciones as obs', 'periods.fecha_inicio as fi', 'periods.fecha_fin as ff','periods.clave as claves', DB::raw("concat(users.name,' ',users.apellido_paterno,
        ' ', users.apellido_materno) as nombre"),'users.estudio_maximo')
        ->get();

        $pdf = Pdf::loadView('livewire.admin.coursedetails.dowlandlistcourse', ['courses' => $coursesdetails]);
        $pdf_file = storage_path('app/')."Listado de cursos.pdf";
        $pdf->setPaper("A4",'landscape');
        $pdf->save($pdf_file);
        return response()->download($pdf_file)->deleteFileAfterSend();
    }
}
