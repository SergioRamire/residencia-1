<?php

namespace App\Http\Livewire\Admin;

use App\Models\Area;
use App\Models\Complaint;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TranslationController extends Component
{
    use WithPagination;
    use WithSorting;
    use AuthorizesRequests;

    public Area $areas;
    public $edit = false;
    public $create = false;

    public $showEditCreateModal = false;
    public $confirmingAreaDeletion = false;
    public $confirmingSaveArea = false;

    //variables de activar area
    public bool $confirming_area_active =false;
    public bool $confirming_area_Inactive =false;
    public $area;
    public bool $showConfirmationModal = false;

    public bool $permiso_eliminicacion = false;

    public $perPage = '8';
    public $search = '';
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];


    public function render(){
        // $a = Complaint::all();
        // dd('hola');
        // dd($a);
        return view('livewire.admin.seguimientos.index',[
            // 'dat' => Complaint::
                'dat' => Complaint::join('citizen_reports','citizen_reports.complaint_id', '=', 'complaints.id')
                ->where('name', 'like', '%'.$this->search.'%')

            ->orWhere('description', 'like', '%'.$this->search.'%')
            ->select('complaints.*','citizen_reports.date','citizen_reports.status')
            // ->orWhere('cost', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage),
        ]);
    }

}
