<?php

namespace App\Http\Livewire\Admin;

use App\Models\Area;
use App\Models\Contribution;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContributionController extends Component
{
    use WithPagination;
    use WithSorting;
    use AuthorizesRequests;

    public $perPage = '8';
    public $search = '';
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public function render(){
        return view('livewire.admin.adeudos.index',[
                'datos' => Contribution::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('description', 'like', '%'.$this->search.'%')
            ->orWhere('cost', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage),
        ]);}
}
