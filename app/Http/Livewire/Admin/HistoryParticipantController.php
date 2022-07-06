<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Models\User;

class HistoryParticipantController extends Component{

    use WithPagination;
    use WithSorting;

    public $perPage = 8;
    public $filters1 = '';
    public $filters2 = '';
    public $per_id = '';
    public $cur_id = '';


    public $filters = [
        'filtro_curso' => '',
        'filtro_perfil'=>'',
    ];

    protected $queryString = [
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];
    public function resetFilters(){
        $this->reset('filters');
        $this->reset('filters1');
        $this->reset('filters2');
        $this->reset('per_id');
        $this->reset('cur_id');
    }
    private function resetInputFields(){
        $this->per_id = '';
        $this->cur_id = '';
        $this->filters1 = '';
        $this->filters2 = '';
    }

    public function render()
    {
        return view('livewire.admin.historyparticipant.index', [
            'history' => $this->consulta()->orderBy('courses.id', $this->sortDirection)->paginate($this->perPage),
        ]);
    }
    public function consulta(){
        return User::join('inscriptions','inscriptions.user_id','users.id')
        ->join('course_details','course_details.id','inscriptions.course_detail_id')
        ->join('periods', 'periods.id', '=', 'course_details.period_id')
        ->join('courses', 'courses.id', '=', 'course_details.course_id')
        ->join('groups', 'groups.id', '=', 'course_details.group_id')
        ->when($this->filters1, fn ($query, $b) => $query
            ->where('periods.fecha_inicio', '>=', $b))
        ->when($this->filters2, fn ($query, $b) => $query
            ->where('periods.fecha_fin', '<=', $b))

            ->when($this->filters['filtro_curso'], fn ($query, $b) => $query
                ->where('course_details.course_id', '=', $b))

            ->when($this->filters['filtro_perfil'], fn ($query, $b) => $query
                ->where('courses.perfil', 'like', '%'.$b.'%'))
            // ->when($this->estatus, fn ($query, $b) => $query
            //     ->where('inscriptions.estatus_participante', 'like', '$'.$b.'$'))
        // ->where('periods.id','=',$this->per_id )
        // ->where('courses.id','=',$this->cur_id )
        ->where('inscriptions.estatus_participante','like','Participante')
        ->select(
            'users.name','users.rfc','users.apellido_paterno as ap1','users.apellido_materno as ap2',
            'courses.clave as cl','courses.nombre as nom','courses.perfil as per',
            'periods.fecha_inicio as f1','periods.fecha_fin as f2','periods.clave',
            'groups.nombre as gnom',
        );
    }
    protected $listeners = [
        'send_curso',
    ];

    public function send_curso($valor){
        $this->filters['filtro_curso'] = $valor;
    }


}
