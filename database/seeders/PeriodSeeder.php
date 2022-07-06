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
        $f1->estado = 0;
        $f1->publico = 0;
        $f1->save();

        $f2 = new Period();
        $f2->clave  ='2-ENE/JUN2022';
        $f2->fecha_inicio ='2022-07-18';
        $f2->fecha_fin = '2022-07-22';
        $f2->estado = 0;
        $f2->publico = 0;
        $f2->save();

        // Period::factory()
        //     ->count(2)
        //     ->create();
    }
}
