<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Period;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class InsControllerller extends Component
{
    public User $user;
    public int $perPage = 5;
    public $arreglo = [];
    public $keyCache = 'horario'; /* .auth()->user()->id; */

    public function rangoFecha($inicio, $fin){
        return Period::query()
            ->join('course_details', 'periods.id', '=', 'course_details.period_id')
            ->join('courses', 'course_details.course_id', '=', 'courses.id')
            ->select(
                'periods.*',
                'course_details.id as curdet','course_details.*',
                'courses.*',
            )
            ->where('periods.fecha_inicio', '>=', $inicio)
            ->where('periods.fecha_fin', '<=', $fin);
    }
    public function buscar(){
        $i = $this->arreglo;
        return Course::query() 
            ->join('course_details', 'courses.id', '=', 'course_details.course_id')
            ->select('courses.*')
            ->whereIn('courses.id', $i)
            ->get();
    }

    public function render(){
        $this->addcache();
        return view('livewire.admin.ins-controllerller',
            [
                'tabla' => $this->buscar(),
                'semana1' => $this->rangoFecha('2022-06-08', '2022-07-14')->paginate($this->perPage),
                'semana2' => $this->rangoFecha('2022-06-26', '2022-07-02')->paginate($this->perPage),
            ]
        );
    }

    public function addcache(){
        if (Cache::has($this->keyCache)) {
            $this->arreglo = Cache::get($this->keyCache);
            // Cache::forget($this->keyCache);
            // dd('Hay algo en cache');
        } else {
            Cache::put($this->keyCache, $this->arreglo);
            // dd('no hay nada, guarda algo');
        }
    }

    public function updatecache($key, $arreglo){
        Cache::forget($key);
        Cache::put($key, $arreglo);
    }

    public function add($id){
        array_push($this->arreglo, $id);
        $this->updatecache($this->keyCache, $this->arreglo);
        $this-> noti('success','Inscripto al Curso exitosamente');
    }
    public function del($id){
        $aux = [];
        foreach ($this->arreglo as $curso) {
            if ($curso != $id) {
                array_push($aux, $curso);
            }
        }
        $this->arreglo = $aux;
        $this->updatecache($this->keyCache, $this->arreglo);
        $this-> noti('trash','Curso eliminado exitosamente');
    }
 
    public function addHorario(){
        $this->user = User::find(auth()->user()->id);
        foreach ($this->arreglo as $id) {
            $courseDetails = CourseDetail::find($id);
            $this->user->courseDetails()->attach( $courseDetails, [
                        'calificacion' => 0,
                        'estatus_participante' => 'Participante',
                        'asistencias_minimas' => 0,
                    ]);
            }
            Cache::forget($this->keyCache);
            $this-> noti('success','Horario creado Exitosamente');
    }

    public function noti($icon,$txt){
        $this->dispatchBrowserEvent('notify', [
            'icon' => $icon,
            'message' => $txt,
        ]);
    }

}
