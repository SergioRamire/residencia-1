<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;

use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class UserExport implements FromView
{
    use Exportable;

    private $fileName='users.xlsx';
    public $periodo, $curso;
    private $data, $ins;
    private $imagen ='https://d2jnbxtr5v4vqu.cloudfront.net/images/12-2017_10_19_19_43_18.jpg';
    // private $logo =drawings();
    // private $x;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($data, $ins)
    {
        // $this->periodo = $periodo;
        // $this->curso = $curso;
        $this->data=$data;
        $this->ins=$ins;
    }



    public function view(): View
    {

        return view('livewire.admin.excel.viewexcel',[
            'data' => $this->data,
            'instructor' => $this->ins,
            'ima'=>$this->imagen,
        ]);
    }

}
