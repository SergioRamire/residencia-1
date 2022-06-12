<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Area::factory()
        //     ->count(8)
        //     ->create();
        DB::table('areas')->insert([
            'clave' => '9883',
            'nombre' => 'Departamento de Ciencias Básicas',
            'jefe_area' => 'Dr. Rubén Doroteo Castillejos',
            'telefono' =>9515015016,
            'extension' =>136,
          ]);
        DB::table('areas')->insert([
            'clave' => '9123',
            'nombre' => 'Departamento de Metal Mecánica',
            'jefe_area' => 'M.A. Efrén Normando Enríquez Porras',
            'telefono' =>9515015016,
            'extension' =>138,
          ]);
        DB::table('areas')->insert([
            'clave' => '2351',
            'nombre' => 'Departamento de Sistemas y Computación',
            'jefe_area' => 'M.C. Maricela Morales Hernández',
            'telefono' =>9515015016,
            'extension' =>123,
          ]);
        DB::table('areas')->insert([
            'clave' => '9234',
            'nombre' => 'Departamento de Ciencias de la Tierra',
            'jefe_area' => 'M.A. Edgar Alberto Cortes Jiménez',
            'telefono' =>9515015016,
            'extension' =>130,
          ]);
        DB::table('areas')->insert([
            'clave' => '1062',
            'nombre' =>  'Departamento de Ingeniería Química',
            'jefe_area' => 'M.C. Minerva Donají Méndez López',
            'telefono' =>9515015016,
            'extension' =>117,
          ]);
        DB::table('areas')->insert([
            'clave' => '3145',
            'nombre' =>  'Departamento de Ingeniería Industrial',
            'jefe_area' => 'M.C. Martha Hilaria Bartolo Alemán',
            'telefono' =>9515015016,
            'extension' =>117,
          ]);
        DB::table('areas')->insert([
            'clave' => '1034',
            'nombre' =>  'Departamento de Ingeniería Eléctrica',
            'jefe_area' => 'Ing. Adrián Gómez Ordaz',
            'telefono' =>9515015016,
            'extension' =>128,
          ]);
        DB::table('areas')->insert([
            'clave' => '2761',
            'nombre' =>  'Departamento de Ingeniería Electrónica',
            'jefe_area' => 'Ing. Roberto Tamar Castellanos Baltazar',
            'telefono' =>9515015016,
            'extension' =>126,
          ]);
        DB::table('areas')->insert([
            'clave' => '9162',
            'nombre' =>  'Departamento de Ciencias Económico Administrativas',
            'jefe_area' => 'José Alfredo Reyes Juárez',
            'telefono' =>9515015016,
            'extension' =>132,
          ]);
        DB::table('areas')->insert([
            'clave' => '3211',
            'nombre' =>  'Departamento de Desarrollo Académico',
            'jefe_area' => 'L.I. Virginia Ortíz Méndez',
            'telefono' =>9515015016,
            'extension' =>134,
          ]);
    }
}
