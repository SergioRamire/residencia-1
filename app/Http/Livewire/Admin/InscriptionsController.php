<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Period;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

use App\Http\Livewire\Admin\EmailController;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarEmailCurso;


class InscriptionsController extends Component
{
    use WithPagination;
    public User $user;
    public int $per_page = 8;
    public int $per_page2 = 8;
    public $arreglo = [];
    public $arreglo1 = [];
    public $unionarreglos = [];
    public int $countabla1 = 1;
    public int $countabla2 = 1;
    public $horas_inicio_semana1=[];
    public $horas_inicio_semana2=[];
    public $id_arreglo=[];
    public $id_arreglo1=[];
    public $con;
    public $c=[1,1,1,1,1];
    public $arreglo_fecha=[];
    public $permiso = true;
    public bool $segunda_semana_activa=true;
    /* Verificacion si hay cursos */
    public $disponible = false;

    public $showOneModal = false;

    public bool $flag = false;


    public bool $btn_continuar = false;
    public bool $show_horario = false;
    public bool $confirming_save_inscription = false;
    protected $queryString = [
        'per_page' => ['except' => 8, 'as' => 'p'],
        'per_page2' => ['except' => 8, 'as' => 'p2'],
    ];

    public bool $btn_semana_1 = false;
    public bool $btn_semana_2 = false;

    public function btn_switch_1(){
        $this->btn_semana_1 = $this->alternar_bool($this->btn_semana_1);
        if ($this->btn_semana_2 == true) {
            $this->btn_semana_2 = $this->alternar_bool($this->btn_semana_2);
        }
    }

    public function btn_switch_2(){
        $this->btn_semana_2 = $this->alternar_bool($this->btn_semana_2);
        if ($this->btn_semana_1 == true) {
            $this->btn_semana_1 = $this->alternar_bool($this->btn_semana_1);
        }
    }

    public function alternar_bool($valor){
        if($valor){
            $valor = false;
        }else{
            $valor = true;
        }
        return $valor;
    }

    public function open_show_horario(){
        $this->show_horario = true;
    }

    public function close_show_horario(){
        $this->show_horario = false;

    }

    public function cambiar_estado_boton_conntinuar(){
        $this->btn_continuar = true;
    }

    public function mostrar_modal_de_verificacion(){
        $this->show_horario = false;
        $this->showOneModal = true;

    }

    public function open_confir(){
        $this->confirming_save_inscription = true;
    }

    public function reset_arreglo(){
        $this->reset('arreglo');
    }

    public function seleccionar_curso_tabla2($id){

        if($this->countabla2<3){
            $cap=CourseDetail::select('course_details.capacidad')
                ->where('course_details.id',"=",$id)
                ->get();
            $participantes_inscritos = $this->consultar_inscritos_en_curso($id);
            if($participantes_inscritos<$cap[0]->capacidad){
                $h2=CourseDetail::select('course_details.hora_inicio')
                            ->where('course_details.id', "=",$id)
                            ->get();
                $hi2=$h2[0]->hora_inicio;
                if(in_array($hi2,$this->horas_inicio_semana2)){
                    $this-> noti('info','Ya escogiste un curso con este horario');
                }
                else{
                    array_push($this->horas_inicio_semana2,$hi2);
                    $this->countabla2=$this->countabla2+1;
                    array_push($this->arreglo1, $id);
                    array_push($this->id_arreglo1, $id);
                    $this-> noti('success','Curso seleccionado ');
                }
            }
            else{
                $this-> noti('info','Capacidad llena del curso seleccionado');
            }
        }
        elseif($this->countabla2>2){
            $this-> noti('info','No se pueden seleccionar más de 2 cursos por semana ',);
        }
        $this->consultar_cursos_seleccionados();
    }

    public function consultar_horario_para_instructores($period_id){
        $id_user = auth()->user()->id;
        $horario = User::select('course_details.hora_inicio')
                        ->join('inscriptions','inscriptions.user_id','=','users.id')
                        ->join('course_details','course_details.id','=','inscriptions.course_detail_id')
                        ->join('periods','periods.id','=','course_details.period_id')
                        ->where('inscriptions.user_id','=',$id_user)
                        ->where('inscriptions.estatus_participante','=','Instructor')
                        ->where('periods.id','=',$period_id)
                        ->first();
        return $horario->hora_inicio;
    }

    public function seleccionar_curso_tabla1($id){
        if($this->countabla1<3){
            $cap=CourseDetail::select('course_details.capacidad')
                             ->where('course_details.id',"=",$id)
                             ->get();
            $participantes_inscritos = $this->consultar_inscritos_en_curso($id);
            if($participantes_inscritos<$cap[0]->capacidad){
                $h=CourseDetail::select('course_details.hora_inicio')
                            ->where('course_details.id', "=",$id)
                            ->get();
                $hi=$h[0]->hora_inicio;
                if(in_array($hi,$this->horas_inicio_semana1)){
                    $this-> noti('info','Ya escogiste un curso con este horario');
                }
                else{
                    array_push($this->horas_inicio_semana1,$hi);
                    $this->countabla1=$this->countabla1+1;
                    array_push($this->arreglo, $id);
                    array_push($this->id_arreglo, $id);
                    $this-> noti('success','Curso seleccionado ');
                }
            }
            else{
                $this-> noti('info','Capacidad llena del curso seleccionado');
            }
        }
        elseif($this->countabla1>2){
            $this-> noti('info','No se pueden seleccionar más de 2 cursos por semana ');
        }
        $this->consultar_cursos_seleccionados();
    }

    public function consultar_inscritos_en_curso($id){
        $users = CourseDetail::
                join('inscriptions as i', 'i.course_detail_id', '=', 'course_details.id')
                ->where('i.course_detail_id', "=",$id)
                ->where('i.estatus_participante', "=",'Participante')
                ->selectRaw('count(*) as user_count')
                ->first();
        return $users->user_count;
    }

    public function evaluar_cantidad_cursos_seleccionados(){
        if(count($this->consultar_cursos_seleccionados())!==0)
            $this->btn_continuar = true;
        else
            $this->btn_continuar = false;
    }

    public function consultar_cursos_seleccionados(){
        $this->unionarreglos=array_merge($this->arreglo,$this->arreglo1);
        $i = array_merge($this->arreglo,$this->arreglo1);
        return Period::query()
            ->join('course_details', 'periods.id', '=', 'course_details.period_id')
            ->join('courses', 'course_details.course_id', '=', 'courses.id')
            ->select('periods.fecha_inicio','periods.fecha_fin',
            'course_details.id as curdet','course_details.*',
            'courses.nombre','courses.perfil','courses.dirigido')
            ->whereIn('course_details.id', $i)
            ->get();
    }

    public function consultar_cursos_disponibles($fecha_inicio){
        $a=$this->id_arreglo;
        $b=$this->id_arreglo1;
        return Period::query()
            ->join('course_details', 'periods.id', '=', 'course_details.period_id')
            ->join('courses', 'course_details.course_id', '=', 'courses.id')
            ->select(
                'course_details.id as curdet','course_details.*',
                'courses.nombre','courses.dirigido','courses.perfil',

            )
            ->where('periods.fecha_inicio', '=', $fecha_inicio)
            ->whereNotIn('course_details.id',$a)
            ->whereNotIn('course_details.id',$b)
            ;
    }

    public function render(){
        $this->evaluar_cantidad_cursos_seleccionados();
        $this->consulta_periodos_a_publicar();
        $this->verficar_mostrar_cursos();
        $this->verificar_inscripciones_recientes_de_usuario();
        if(count($this->arreglo_fecha)==4 and $this->disponible==true){
            return view('livewire.admin.inscriptions.index',
            [
                'tabla' => $this->consultar_cursos_seleccionados(),
                'semana1' => $this->consultar_cursos_disponibles($this->arreglo_fecha[0])->paginate($this->per_page),
                'semana2' => $this->consultar_cursos_disponibles($this->arreglo_fecha[2])->paginate($this->per_page2),
            ]
                );
            }
        if(count($this->arreglo_fecha)==2 and $this->disponible==true){
            $this->segunda_semana_activa=false;
            return view('livewire.admin.inscriptions.index',
                [
                    'tabla' => $this->consultar_cursos_seleccionados(),
                    'semana1' => $this->consultar_cursos_disponibles($this->arreglo_fecha[0])->paginate($this->per_page),
                ]
            );
        }
        return view('livewire.admin.inscriptions.index');
    }

    public function verficar_mostrar_cursos(){
        if(count($this->arreglo_fecha)!==0){
            $fecha_inicio_periodo_activo1 = date('Y-m-d',strtotime($this->arreglo_fecha[0]));
            $date = Carbon::now();
            if($fecha_inicio_periodo_activo1>$date->toDateString()){
                $this->disponible =true;
            }
        }
        else{
            $this->disponible =false;
        }
    }

    public function verificar_inscripciones_recientes_de_usuario(){
        $id_user = User::find(auth()->user()->id);
        $inscripciones = User::select('inscriptions.course_detail_id')
                        ->join('inscriptions','inscriptions.user_id','=','users.id')
                        ->join('course_details','course_details.id','=','inscriptions.course_detail_id')
                        ->join('periods','periods.id','=','course_details.period_id')
                        ->where('users.id','=',$id_user)
                        ->where('inscriptions.estatus_participante','=','Participante')
                        ->where('periods.ofertado','=',1)
                        ->get();
        if(count($inscripciones)!==0){
            $this->permiso=false;
        }
        else{
            $this->permiso=true;
        }
    }

    public function consulta_periodos_a_publicar(){
        $periodos = Period::select('periods.fecha_inicio','periods.fecha_fin')
            ->where('ofertado' , '=', 1)
            ->orderBy('periods.fecha_inicio', 'asc')
            ->get();
        $count=0;
        // if(count($this->arreglo_fecha)==4){
            foreach($periodos as $p){
                $this->arreglo_fecha[$count] = $p->fecha_inicio;
                $count = $count + 1;
                $this->arreglo_fecha[$count] = $p->fecha_fin;
                $count = $count + 1;
            }
        // }
        // else{
        //     $this->disponible =false;
        // }
    }

    public function descartar_curso($id){
        if(in_array($id,$this->arreglo)){
            $this->countabla1=$this->countabla1-1;
            $indice1=array_search($id, $this->arreglo);
            $indice2=array_search($id, $this->id_arreglo);
            unset($this->arreglo[$indice1]);
            unset($this->id_arreglo[$indice2]);
        }
        elseif(in_array($id,$this->arreglo1)){
            $this->countabla2=$this->countabla2-1;
            $indice3=array_search($id, $this->arreglo1);
            $indice4=array_search($id, $this->id_arreglo1);
            unset($this->arreglo1[$indice3]);
            unset($this->id_arreglo1[$indice4]);
        }
        $indice5=array_search($id, $this->horas_inicio_semana1);
        unset($this->horas_inicio_semana1[$indice5]);
        $indice6=array_search($id, $this->horas_inicio_semana2);
        unset($this->horas_inicio_semana2[$indice6]);
        $this->unionarreglos=array_merge($this->arreglo,$this->arreglo1);
        $this->consultar_cursos_seleccionados();
        $this-> noti('trash','Curso descartado');
    }

    public function abrir_horario(){
        $this->open_show_horario();
    }

    public function store(){
        $this->confirming_save_inscription = false;
        $this->show_horario = false;
        $this->flag = false;
        $this->user = User::find(auth()->user()->id);
        foreach ($this->unionarreglos as $id) {
            $courseDetails = CourseDetail::find($id);
                $this->user->courseDetails()->attach( $courseDetails, [
                        'calificacion' => 0,
                        'estatus_participante' => 'Participante',
                        'asistencias_minimas' => 0,
                    ]);
        }
        app(EmailController::class)->cursos($this->user, $this->unionarreglos);
        $this-> noti('success','Horario creado Exitosamente');
        return redirect()->route('participant.studying');
    }

    public function noti($icon,$txt){
        $this->dispatchBrowserEvent('notify', [
            'icon' => $icon,
            'message' => $txt,
        ]);
    }
    /* Para cambiar al modal final para redirecion */
    public function alter(){
        $this->showOneModal = false;
        $this->confirming_save_inscription = false;
        $this->show_horario = true;
        $this->flag = true;
    }
}
