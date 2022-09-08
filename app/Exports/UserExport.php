<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class UserExport implements FromView
{
    use Exportable;

    private $fileName='users.xlsx';
    private $data, $ins;

    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($data, $ins)
    {
        $this->data=$data;
        $this->ins=$ins;
    }


    public function view(): View
    {
        return view('livewire.admin.excel.viewexcel',[
            'data' => $this->data,
            'instructor' => $this->ins,
            'coordinador' => User::whereRelation('roles', 'name', '=', 'Coordinador')->first(),
        ]);
    }

}
