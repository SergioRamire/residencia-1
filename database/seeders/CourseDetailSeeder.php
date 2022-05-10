<?php

namespace Database\Seeders;

use App\Models\CourseDetail;
use App\Models\Group;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseDetail::factory()
            ->count(10)
            ->create();

        foreach (User::all() as $user) {
            $faker = Factory::create();
            $courseDetails = CourseDetail::inRandomOrder()->take(rand(1, 2))->pluck('id');
            $user->courseDetails()->attach($courseDetails, [
                'calificacion' => $faker->numberBetween(0, 100),
                'estatus' => $faker->randomElement(['Participante', 'Instructor']),
                'asistencias_minimas' => $faker->numberBetween(0, 1),
            ]);
        }

        foreach (Group::all() as $group) {
            $faker = Factory::create();
            $courseDetails = CourseDetail::inRandomOrder()->take(rand(1, 2))->pluck('id');

            $hora_inicio = $faker->time('H:i');
            $group->courseDetails()->attach($courseDetails, [
                'hora_inicio' => $hora_inicio,
                'hora_fin' => date('H:i', strtotime($hora_inicio.'+1 hour')),
            ]);
        }
    }
}
