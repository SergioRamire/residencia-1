<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithFilters;
use App\Http\Traits\WithSearching;
use App\Http\Traits\WithSorting;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Invoice;
use App\Models\CourseDetail;
use App\Models\Period;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ParticipantListsController extends Component
{
    use WithFilters;
    use WithPagination;
    use WithSearching;
    use WithSorting;
    use AuthorizesRequests; 

    public $perPage = '8';
    // public $search = '';
    protected array $cleanStringsExcept = ['search'];
    public array $classification = [
        'curso' => '',
        'periodo' => '',
    ];
    public array $filters = [
        'grupo' => '',
        'departamento' => '',
    ];
    public bool $consulta = false;
    public $id_usuario;
    public $id_curso_grupo;
    public $id_per_;
    public $peri;
    public $nombre_curso;
    public bool $aceptado=true;
    public bool $inscripcion_denegada=false;
    public $hora_inicio;
    public $hora_fin;
    public User $participante;
    public Period $periodo;

    public function mount(){
        $this->participante = User::make();
        $this->periodo = Period::make();
    }

    protected $queryString = [
        'perPage' => ['except' => 8, 'as' => 'p'],
    ];

    public bool $edit = false;
    public bool $create = false;
    public bool $showEdit_create_modal = false;
    public bool $confirming_participant_deletion = false;
    public bool $confirming_save_participant = false;

    public function rules(): array{
        if ($this->edit) {
            return [
                'id_usuario' => ['required', 'numeric'],
                'id_curso_grupo' => ['required', 'numeric'],
        ];}
        return [
            'id_usuario' => ['required', 'numeric'],
            'id_curso_grupo' => ['required', 'numeric'],
        ];
    }

    public function mostrar($periodo, $curso)
    {
        $buscar=$this->search;
        return  User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
        ->join('areas', 'areas.id', '=', 'users.area_id')
        ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
        ->join('courses', 'courses.id', '=', 'course_details.course_id')
        ->join('groups', 'groups.id', '=', 'course_details.group_id')
        ->join('periods', 'periods.id', '=', 'course_details.period_id')
        ->where('inscriptions.estatus_participante', '=', 'Participante')
        ->where('course_details.period_id', '=', $periodo)
        ->where('course_details.course_id', '=', $curso)
        ->select('inscriptions.id','users.id as id_user', DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"), 'users.name','users.apellido_paterno','users.apellido_materno','users.rfc',
            'courses.nombre as curso','groups.nombre as grupo',
            'areas.nombre as area', 'periods.id as id_periodo', 'periods.fecha_inicio',
            'periods.fecha_fin', 'course_details.id as id_detallecurso')
            ->where(function ($query) use ($buscar) {
                $query->Where(DB::raw("concat(users.name,' ',users.apellido_paterno,
                ' ', users.apellido_materno)"), 'like', '%'.$buscar.'%')
                      ->orwhere('users.name', 'like', '%'.$buscar.'%')
                      ->orWhere('areas.nombre', 'like', '%'.$buscar.'%')
                      ->orWhere('users.apellido_materno', 'like', '%'.$buscar.'%')
                      ->orWhere('users.apellido_paterno', 'like', '%'.$buscar.'%')
                      ->orWhere('courses.nombre', 'like', '%'.$buscar.'%')
                      ->orWhere('users.rfc', 'like', '%'.$buscar.'%')
                      ->orWhere('groups.nombre', 'like', '%'.$buscar.'%');
            })
        ->when($this->filters['grupo'], fn ($query, $grupo) => $query->where('course_details.group_id', '=', $grupo))
        ->when($this->filters['departamento'], fn ($query, $depto) => $query->where('users.area_id', '=', $depto))
        ->distinct()
        ->orderBy('users.apellido_paterno', 'asc');
    }

    private function resetInputFields()
    {
        $this->nombre = '';
        $this->rfc = '';
    }

    public function create(){
        $this->authorize('participantlists.create');
        $this->resetInputFields();
        $this->emit('valorParticipante','');
        $this->emit('valorPerio','');
        $this->emit('valorCursoGrupo','');
        $this->showEdit_create_modal = true;
        $this->confirming_participant_deletion = false;
        $this->confirming_save_participant = false;
        $this->edit = false;
        $this->create = true;
    }

    public function edit($id,$id_per,$id_detallecurso){
        $this->authorize('participantlists.edit');
        $this->id_usuario = $id;
        $this->id_curso_grupo = $id_detallecurso;
        $this->id_per_ = $id_per;

        $this->edit_user = $id;
        $this->edit_curso = $id_detallecurso;

        // $this->emit('valorParticipante',$id);
        $this->emit('valorPerio',$id_per);
        $this->emit('valorCursoGrupo',$id_detallecurso);
        $this->participante = User::find($id);
        $this->periodo = Period::find($id_per);

        $this->edit = true;
        $this->create = false;
        $this->showEdit_create_modal = true;
    }

    public function evaluar_inscripcion(){
        $this->inspeccionar_horarios();
        $this->inspeccionar_instructor();
        if($this->aceptado== false){
            $this->inscripcion_denegada=true;
        }else{
            $this->inscripcion_denegada=false;
            $this->confirming_save_participant = true;}
    }

    public function inspeccionar_horarios(){
        $horario= CourseDetail::select('course_details.hora_inicio','course_details.hora_fin','course_details.period_id')
                                ->where('course_details.id','=',$this->id_curso_grupo)
                                ->first();
        $consulta = User::join('inscriptions','inscriptions.user_id','users.id')
                        ->join('course_details','course_details.id','inscriptions.course_detail_id')
                        ->join('courses','courses.id','course_details.course_id')
                        ->where('users.id','=',$this->id_usuario)
                        ->where('course_details.period_id','=',$horario->period_id)
                        ->where('course_details.hora_inicio','=',$horario->hora_inicio)
                        ->select('courses.nombre')
                        ->first();
        if($consulta!==null){
            $this->aceptado=false;
            $this->nombre_curso= $consulta->nombre;
            $this->hora_inicio = $horario->hora_inicio;
            $this->hora_fin = $horario->hora_fin;
        }
        else{
            $this->aceptado=true;
        }
    }

    // public function inspeccionar_instructor(){
    //     $id_curso = CourseDetail::join('courses','courses.id','course_details.course_id')
    //                             ->select('courses.id')
    //                             ->where('course_details.id','=',$this->id_curso_grupo)
    //                             ->first();
    //     $id=$id_curso->id;
    //     $consultar_curso_instruido =  User::join('inscriptions','inscriptions.user_id','users.id')
    //                             ->join('course_details','course_details.id','inscriptions.course_detail_id')
    //                             ->join('courses','courses.id','course_details.course_id')
    //                             ->select('courses.id')
    //                             ->where('users.id','=',$this->id_usuario)
    //                             ->where('inscriptions.estatus_participante','=','Instructor')
    //                             ->get();
    //     $cursos_instruidos = [];
    //     foreach($consultar_curso_instruido as $curso){
    //         array_push($cursos_instruidos, $curso->id);
    //     }
    //     if(in_array($id,$cursos_instruidos))
    //         $this->instructor=true;
    //     $this->instructor=false;
    // }

    public function store(){
        $aux_user = $this->id_usuario;
        $aux_detallercurso = $this->id_curso_grupo;
        $user = User::find($aux_user);
        $courseDetails = CourseDetail::find($aux_detallercurso);
        $user->courseDetails()->attach( $courseDetails, [
                'calificacion' => 0,
                'estatus_participante' => 'Participante',
                'asistencias_minimas' => 0,
                'url_cedula' => '',
                // 'calificacion' => 0,
                // 'estatus_participante' => 'Participante',
                // 'asistencias_minimas' => 0,
            ]
        );
        $this->noti('success','Participante creado');
        $this->showEdit_create_modal = false;
        $this->confirming_participant_deletion = false;
        $this->confirming_save_participant = false;
    }

    public $edit_user;
    public $edit_curso;

    public function update(){

        $aux_user = $this->edit_user;
        $aux_detallercurso = $this->edit_curso;

        $user = User::find($aux_user);
        $courseDetails = CourseDetail::find($aux_detallercurso);
        $user->courseDetails()->updateExistingPivot( $courseDetails, [
                'user_id' => $this->id_usuario,
                'course_detail_id' => $this->id_curso_grupo,
            ]
        );

        $this->noti('pencil','Participante actualizado');
        $this->showEdit_create_modal = false;
        $this->confirming_participant_deletion = false;
        $this->confirming_save_participant = false;
    }
    public $id_delete;

    public function delete($id){
        $this->authorize('participantlists.delete');
        $this->id_delete = $id;
        $this->confirming_participant_deletion = true;
    }
    public function destroy()
    {
        DB::table('inscriptions')->delete($this->id_delete);
        $this->noti('trash','Participante eliminado');
        $this->showEdit_create_modal = false;
        $this->confirming_participant_deletion = false;
        $this->confirming_save_participant = false;
    }

    public function consultar()
    {
        $this->consulta = true;
    }

    public function render()
    {
        $this->emit('valueInstitutoOrigen','Tecnologico de oaxaca');
        return view('livewire.admin.lists.index', [
            'lists'=>$this->mostrar($this->classification['periodo'], $this->classification['curso'])
            ->paginate($this->perPage),
        ]);
        $this->resetFilters();
    }

    public function descarga(){
        $data=$this->participants($this->classification['periodo'], $this->classification['curso'],'Participante',$this->filters['grupo']);
        $ins=$this->instructor($this->classification['periodo'], $this->classification['curso'],$this->filters['grupo']);
        return Excel::download(new UserExport($data, $ins), 'Lista_Asistencia.xlsx');
        // dd($ins);
    }

    public function participants($periodo, $curso, $user, $grupo)
    {
        return  User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
        ->join('areas', 'areas.id', '=', 'users.area_id')
        ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
        ->join('courses', 'courses.id', '=', 'course_details.course_id')
        ->join('groups', 'groups.id', '=', 'course_details.group_id')
        ->join('periods', 'periods.id', '=', 'course_details.period_id')
        ->where('inscriptions.estatus_participante', '=', $user)
        ->where('course_details.period_id', '=', $periodo)
        ->where('course_details.course_id', '=', $curso)
        ->select('inscriptions.id',DB::raw("concat(users.name,' ',users.apellido_paterno,
        ' ', users.apellido_materno) as nombre"),'users.name as name','users.apellido_paterno as app','users.apellido_materno as apm','users.rfc as rfc','users.curp as curp','users.sexo as sex','courses.clave as clave','courses.duracion as duracion','courses.nombre as curso','groups.nombre as grupo','course_details.modalidad as modalidad',
        'areas.nombre as area', 'periods.fecha_inicio as fi', 'periods.fecha_fin as ff','course_details.hora_inicio as hi','course_details.hora_fin as hf')
        ->when($this->filters['grupo'], fn ($query, $grupo) => $query->where('course_details.group_id', '=', $grupo))
        ->orderBy('app', 'asc')->get();
    }

    public function instructor($periodo, $curso, $grupo)
    {
        return  User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
        ->join('areas', 'areas.id', '=', 'users.area_id')
        ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
        ->join('courses', 'courses.id', '=', 'course_details.course_id')
        ->join('groups', 'groups.id', '=', 'course_details.group_id')
        ->join('periods', 'periods.id', '=', 'course_details.period_id')
        ->where('inscriptions.estatus_participante', '=', 'Instructor')
        ->where('course_details.period_id', '=', $periodo)
        ->where('course_details.course_id', '=', $curso)
        ->select('inscriptions.id',DB::raw("concat(users.name,' ',users.apellido_paterno,
        ' ', users.apellido_materno) as nombre"),'users.name as name','users.apellido_paterno as app','users.apellido_materno as apm','users.rfc as rfc','users.curp as curp','users.sexo as sex','courses.clave as clave','courses.duracion as duracion','courses.nombre as curso','groups.nombre as grupo','course_details.modalidad as modalidad',
        'areas.nombre as area', 'periods.fecha_inicio as fi', 'periods.fecha_fin as ff','course_details.hora_inicio as hi','course_details.hora_fin as hf')
        ->when($this->filters['grupo'], fn ($query, $grupo) => $query->where('course_details.group_id', '=', $grupo))
        ->orderBy('app', 'asc')->first();
    }

    protected $listeners = [
        'per_send',
        'data_send',
        'user_id_participante',
        'send_curso_grupo',
        'per_send2',
    ];
    public function per_send($valor){
        $this->classification['periodo'] = $valor;
    }
    public function data_send($valor){
        $this->classification['curso'] = $valor;
    }
    public function user_id_participante($valor){
        $this->id_usuario = $valor;
    }
    public function per_send2($valor){
        $this->id_per_ = $valor;
    }
    public function send_curso_grupo($valor){
        $this->id_curso_grupo = $valor;
    }

    public function noti($icon,$txt){
        $this->dispatchBrowserEvent('notify', [
            'icon' => $icon,
            'message' => $txt,
        ]);
    }
}
