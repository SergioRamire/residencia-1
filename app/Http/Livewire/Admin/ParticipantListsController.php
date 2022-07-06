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

class ParticipantListsController extends Component
{
    use WithFilters;
    use WithPagination;
    use WithSearching;
    use WithSorting;

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
    public $curso;

    // public $periodo;
    protected $queryString = [
        'perPage' => ['except' => 8, 'as' => 'p'],
    ];

    public bool $edit = false;
    public bool $create = false;
    public bool $showEditCreateModal = false;
    public bool $confirmingParticipantDeletion = false;
    public bool $confirmingSaveParticipant = false;

    public function rules(): array
    {
        if ($this->edit) {
            return [
                'id_usuario' => ['required', 'numeric'],
                'id_curso_grupo' => ['required', 'numeric'],
            ];
        }

        return [
            'id_usuario' => ['required', 'numeric'],
            'id_curso_grupo' => ['required', 'numeric'],
        ];
    }

    public function mostrar($periodo, $curso)
    {
        return  User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
        ->join('areas', 'areas.id', '=', 'users.area_id')
        ->join('course_details', 'course_details.id', 'inscriptions.course_detail_id')
        ->join('courses', 'courses.id', '=', 'course_details.course_id')
        ->join('groups', 'groups.id', '=', 'course_details.group_id')
        ->join('periods', 'periods.id', '=', 'course_details.period_id')
        ->where('inscriptions.estatus_participante', '=', 'Participante')
        ->where('course_details.period_id', '=', 1)
        ->where('course_details.course_id', '=', 10)
        // ->when($periodo, fn ($query,$p) => $query
        //     ->where('course_details.course_id', '=', $p))
        // ->when($curso, fn ($query,$c) => $query
        //     ->where('course_details.period_id', '=', $c))
        ->select('inscriptions.id',DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno) as nombre"),
            'users.id as id_user','users.name','users.apellido_paterno','users.apellido_materno','users.rfc',
            'courses.nombre as curso','courses.id as id_curso','groups.nombre as grupo','course_details.id as id_detallecurso',
            'areas.nombre as area', 'periods.fecha_inicio', 'periods.fecha_fin', 'periods.id as id_per')
        ->when($this->search, fn ($query, $search) => $query
            ->where('users.name', 'like', '%'.$this->search.'%')
            ->orWhere('users.rfc', 'like', '%'.$this->search.'%')
            ->orWhere('areas.nombre', 'like', '%'.$this->search.'%')
            ->orWhere('courses.nombre', 'like', '%'.$this->search.'%')
            ->orWhere('groups.nombre', 'like', '%'.$this->search.'%'))
         //  ->when($curso, fn ($query, $search) => $query->where('courses.id', $search))
        ->when($this->filters['grupo'], fn ($query, $grupo) => $query->where('course_details.group_id', '=', $grupo))
        ->when($this->filters['departamento'], fn ($query, $depto) => $query->where('users.area_id', '=', $depto))

         ->orderBy($this->sortField, $this->sortDirection);
    }

    private function resetInputFields()
    {
        $this->nombre = '';
        $this->rfc = '';
    }

    public function create(){
        $this->resetInputFields();
        $this->emit('valorParticipante','');
        $this->emit('valorPerio','');
        $this->emit('valorCursoGrupo','');
        $this->showEditCreateModal = true;
        $this->confirmingParticipantDeletion = false;
        $this->confirmingSaveParticipant = false;
        $this->edit = false;
        $this->create = true;
    }

    public function edit($id,$id_per,$id_detallecurso){

        $this->id_usuario = $id;
        $this->id_curso_grupo = $id_detallecurso;
        $this->id_per_ = $id_per;

        $this->edit_user = $id;
        $this->edit_curso = $id_detallecurso;

        $this->emit('valorParticipante',$id);
        $this->emit('valorPerio',$id_per);
        $this->emit('valorCursoGrupo',$id_detallecurso);


        $this->edit = true;
        $this->create = false;
        $this->showEditCreateModal = true;
    }

    public function updateParticipant(){
        if ($this->edit) {
            $this->confirmingSaveParticipant = true;
        }else{
            $this->confirmingSaveParticipant = true;
        }
    }

    public function store(){
        $aux_user = $this->id_usuario;
        $aux_detallercurso = $this->id_curso_grupo;

        $user = User::find($aux_user);
        $courseDetails = CourseDetail::find($aux_detallercurso);
        $user->courseDetails()->attach( $courseDetails, [
                'calificacion' => 0,
                'estatus_participante' => 'Participante',
                'asistencias_minimas' => 0,
            ]
        );

        $this->noti('success','Participante creado');
        $this->showEditCreateModal = false;
        $this->confirmingParticipantDeletion = false;
        $this->confirmingSaveParticipant = false;
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
                // 'calificacion' => 0,
                // 'estatus_participante' => 'Participante',
                // 'asistencias_minimas' => 0,
            ]
        );

        $this->noti('pencil','Participante actualizado');
        $this->showEditCreateModal = false;
        $this->confirmingParticipantDeletion = false;
        $this->confirmingSaveParticipant = false;
    }
    public $id_delete;

    public function delete($id)
    {
        // dd($id);
        $this->id_delete = $id;
        $this->confirmingParticipantDeletion = true;
    }
    public function destroy()
    {
        DB::table('inscriptions')->delete($this->id_delete);
        $this->noti('trash','Participante eliminado');
        $this->showEditCreateModal = false;
        $this->confirmingParticipantDeletion = false;
        $this->confirmingSaveParticipant = false;
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
        $ins=$this->participants($this->classification['periodo'], $this->classification['curso'],'Instructor',$this->filters['grupo']);
        return Excel::download(new UserExport($data, $ins), 'Lista_Asistencia.xlsx');
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
        ->when($this->filters['grupo'], fn ($query, $grupo) => $query->where('course_details.group_id', '=', $grupo))->get();
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
