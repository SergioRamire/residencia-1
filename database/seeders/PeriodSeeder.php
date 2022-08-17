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
        $f1->clave  ='1-ENE/JUN2022';
        $f1->fecha_inicio ='2022-07-11';
        $f1->fecha_fin = '2022-07-15';
        $f1->perfil = 0;
        $f1->ofertado = 0;
        $f1->fecha_limite_para_calificar= '2022-07-16';
        $f1->save();

        $f2 = new Period();
        $f2->clave  ='2-ENE/JUN2022';
        $f2->fecha_inicio ='2022-07-18';
        $f2->fecha_fin = '2022-07-22';
        $f2->perfil = 0;
        $f2->ofertado = 0;
        $f2->fecha_limite_para_calificar= '2022-07-23';
        $f2->save();

    }
}
