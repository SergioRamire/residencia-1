<?php

namespace App\Http\Livewire\Admin;

use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Models\User;
use Livewire\Component;

class HistoryInstructor extends Component
{
    use WithPagination;
    use WithSorting;

    public $perPage = 5;
    public $filters = '';
    public $filters2 = '';
    public $per_id = '';
    public $cur_id = '';


    protected $queryString = [
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];
    public function resetFilters(){
        $this->reset('filters');
        $this->reset('filters2');
        $this->reset('per_id');
        $this->reset('cur_id');
    }
    private function resetInputFields(){
        $this->per_id = '';
        $this->cur_id = '';
        $this->filters = '';
        $this->filters2 = '';
    }

    public function render()
    {
        return view('livewire.admin.historyinstructor.index', [
            'history' => $this->consulta()->orderBy('courses.id', $this->sortDirection)->paginate($this->perPage),
        ]);
    }
    public function consulta(){
        return User::join('inscriptions','inscriptions.user_id','users.id')
        ->join('course_details','course_details.id','inscriptions.course_detail_id')
        ->join('periods', 'periods.id', '=', 'course_details.period_id')
        ->join('courses', 'courses.id', '=', 'course_details.course_id')
        ->join('groups', 'groups.id', '=', 'course_details.group_id')
        ->when($this->filters, fn ($query, $b) => $query
            ->where('periods.fecha_inicio', '>=', $b))
            ->when($this->filters2, fn ($query, $b) => $query
                ->where('periods.fecha_fin', '<=', $b))
            ->when($this->cur_id, fn ($query, $b) => $query
                ->where('courses.id', '=', $b))
            ->when($this->per_id, fn ($query, $b) => $query
                ->where('periods.id', '=', $b))
            // ->when($this->estatus, fn ($query, $b) => $query
            //     ->where('inscriptions.estatus_participante', 'like', '$'.$b.'$'))
        // ->where('periods.id','=',$this->per_id )
        // ->where('courses.id','=',$this->cur_id )
        ->where('inscriptions.estatus_participante','like','Instructor')
        ->select(
            'users.name','users.rfc','users.apellido_paterno as ap1','users.apellido_materno as ap2',
            'courses.clave as cl','courses.nombre as nom','courses.perfil as per',
            'periods.fecha_inicio as f1','periods.fecha_fin as f2','periods.clave',
            'groups.nombre as gnom',
        );
    }
    protected $listeners = [
        'per_send',
        'data_send',
    ];
    public function per_send($valor){
        $this->per_id = $valor;
    }
    public function data_send($valor){
        $this->cur_id = $valor;
    }
}
