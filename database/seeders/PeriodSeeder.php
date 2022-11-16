<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f1 = new Period();
        $f1->clave  ='1-ENE/JUN2023';
        $f1->fecha_inicio ='2023-01-9';
        $f1->fecha_fin = '2023-01-13';
        $f1->ofertado = 0;
        $f1->estatus = 1;
        $f1->fecha_limite_para_calificar= '2023-01-16';
        $f1->save();

        $f2 = new Period();
        $f2->clave  ='2-ENE/JUN2023';
        $f2->fecha_inicio ='2023-01-16';
        $f2->fecha_fin = '2023-01-20';
        $f2->ofertado = 0;
        $f2->estatus = 1;
        $f2->fecha_limite_para_calificar= '2023-01-23';
        $f2->save();

    }
}
