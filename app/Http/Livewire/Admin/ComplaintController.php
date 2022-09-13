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

class ComplaintController extends Component
{
    use WithPagination;
    use WithSorting;
    use AuthorizesRequests;


    public function render(){
        return view('livewire.admin.denuncias.index');
    }
}
