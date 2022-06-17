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
        $f1->clave  ='1-JUN2022';
        $f1->fecha_inicio ='2022-06-20';
        $f1->fecha_fin = '2022-06-24';
        $f1->save(); 

        $f2 = new Period();
        $f2->clave  ='2-JUN2022';
        $f2->fecha_inicio = '2022-06-27';
        $f2->fecha_fin = '2022-07-01';
        $f2->save(); 

        // Period::factory()
        //     ->count(2)
        //     ->create();
    }
}
