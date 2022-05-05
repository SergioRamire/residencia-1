<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(20)
            ->create();
        User::create([
                'name'=>'victor ',
                'apellido_paterno'=>'lopez',
                'apellido_materno'=>'sanchez',
                'email'=>'victor19@gmail.com',
                'password'=>bcrypt('1234567'),
                'rfc'=>'RASG581212CJK',
                'curp'=>'RASG581212HOCMND02',
                'sexo'=>'M',
                'carrera'=>'Lic. en administraci{on',
                'tipo'=>'Base',
                'cuenta_moodle'=>'1'

            ]);
    }
}
