<?php

namespace App\Http\Livewire\Admin;

use App\Models\Area;
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


    public function render(){
        return view('livewire.admin.adeudos.index');
    }
}
