<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ListExport implements FromView
{
    use Exportable;

    private $fileName='users.xlsx';
    private $data, $user;

    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($data)
    {
        $this->data=$data;
    }

    public function view(): View
    {

        return view('livewire.admin.excel.download_list',[
            'data' => $this->data,
            'instructor'=>User::find(auth()->user()->id),
            'coordinador' => User::whereRelation('roles', 'name', '=', 'Coordinador')->first(),
        ]);
    }
}
