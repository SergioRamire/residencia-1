<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\CourseDetail;
use App\Models\Period;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class InscriptionController extends Component
{
    public User $user;
    /* pRIMER MODAL */
    public bool $showOneModal = false;
    /* pagination */
    public int $perPage = 5;
    /* horario */
    public $horario;


    public function mount(){
        $this->user = auth()->user();
    }

    public function rules(){
        return [
            'user.rfc' => ['required', 'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/'],
        ];
    }

    public function selecc($id){
        return CourseDetail::query()
        ->join('inscriptions', 'course_details.id', '=', 'inscriptions.course_detail_id')
        ->join('courses', 'course_details.id', '=', 'courses.id')
        ->select(
            'course_details.*',
            'inscriptions.*',
            'courses.*',
        )
        ->where('inscriptions.user_id', '=', $id)
        ->paginate($this->perPage);
    }
    
    public function rangoFecha($inicio, $fin){
        return Period::query()
            ->join('course_details', 'periods.id', '=', 'course_details.period_id')
            ->join('courses', 'course_details.course_id', '=', 'courses.id')
            ->select(
                'periods.*',
                'course_details.*',
                'courses.*',
            )
            ->where('periods.fecha_inicio', '>=', $inicio)
            ->where('periods.fecha_fin', '<=', $fin)
            // ->distinct('periods.id')
            ->paginate($this->perPage);
    }

    public function registro($id){
        // if (Cache::has('horario')) {
        //     $this->horario = Cache::get('horario');
        // }else {
        //     $this->horario = [];
        // }
        // $this->horario = Arr::prepend($this->horario,$id);
        // Cache::put('horario', $this->horario);

        $this->dispatchBrowserEvent('notify', [
                'icon' => 'success',
                'message' => 'Inscripto al Curso exitosamente >> ',$id,
            ]);
    }

        
    public function tabla(){
        return Cache::get('horario');
    }

    public function recorre(){
        
        // $this->horario = [[1,"0"],[2,"0"],[3,"0"]];
        // Cache::put('horario', $this->horario);
        
        $tabla = [];
        if (!is_null( $this->horario)) {
            foreach ($this->horario as $value) {
                // dd($value);
                $curos = CourseDetail::query()
                ->join('courses', 'course_details.id', '=', 'courses.id')
                ->select(
                    // 'course_details.*',
                    'courses.*',
                )
                ->where('courses.id', '=', $value);
                $tabla =Arr::prepend($tabla,$curos);
            }
        }else{
            $this->horario = [1,2,3];

        }

        return $tabla;
    }

    public function delete()
    {
        // dd($id);
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' => 'Curso eliminado exitosamente',
        ]);
    }



    public function render()
    {
        return view(
            'livewire.admin.inscriptions.index',
            [
                'elegidos' => $this->recorre(),
                //CourseDetail::query()
                    //->join('inscriptions', 'course_details.id', '=', 'inscriptions.course_detail_id')
                    //->join('courses', 'course_details.id', '=', 'courses.id')
                    //->select(
                    //'course_details.*',
                    //'inscriptions.*',
                    //'courses.*',
                    //)
                    //->where('inscriptions.user_id', '=', $this->user->id)
                    //->paginate($this->perPage),

                'semana1' => Period::query()
                    ->join('course_details', 'periods.id', '=', 'course_details.period_id')
                    ->join('courses', 'course_details.course_id', '=', 'courses.id')
                    ->select(
                        'periods.*',
                        'course_details.*',
                        'courses.*',
                    )
                    ->where('periods.fecha_inicio', '>=', '2022-06-08')
                    ->where('periods.fecha_fin', '<=', '2022-07-14')
                    // ->distinct('periods.id')
                    ->paginate($this->perPage),
                'semana2' => Period::query()
                    ->join('course_details', 'periods.id', '=', 'course_details.period_id')
                    ->join('courses', 'course_details.course_id', '=', 'courses.id')
                    ->select(
                        'periods.*',
                        'course_details.*',
                        'courses.*',
                    )
                    ->where('periods.fecha_inicio', '>=', '2022-06-26')
                    ->where('periods.fecha_fin', '<=', '2022-07-02')
                    // ->distinct('periods.id')
                    ->paginate($this->perPage),
            ]
        );
    }


}
