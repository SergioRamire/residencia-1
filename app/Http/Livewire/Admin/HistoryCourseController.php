<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSorting;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryCourseController extends Component{

    use WithPagination;
    use WithSorting;

    public $perPage = 8;
    public $filters = '';
    public $filters2 = '';
    protected $queryString = [
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];
    public function resetFilters(){
        $this->reset('filters');
        $this->reset('filters2');
    }
    private function resetInputFields(){
        $this->periodo_id = '';
        $this->clave = '';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
    }

    public function render(){
        return view('livewire.admin.historycourse.index', [
            'history' => $this->consulta()->orderBy('courses.id', $this->sortDirection)->paginate($this->perPage),
        ]);
    }
    public function consulta(){
        return Course::join('course_details','course_details.course_id','courses.id')
        ->join('periods', 'periods.id', '=', 'course_details.period_id')
        ->when($this->filters, fn ($query, $b) => $query
            ->where('periods.fecha_inicio', '>=', $b))
        ->when($this->filters2, fn ($query, $b) => $query
            ->where('periods.fecha_fin', '<=', $b))
        ->select(
            'courses.clave as cl','courses.nombre as nom','courses.perfil as per',
            'periods.fecha_inicio as f1','periods.fecha_fin as f2','periods.clave as percla',
        );
    }
}
