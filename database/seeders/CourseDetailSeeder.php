<?php

namespace Database\Seeders;

use App\Models\CourseDetail;
use App\Models\Period;
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
                'estatus_participante' => $faker->randomElement(['Participante', 'Instructor']),
                'asistencias_minimas' => $faker->numberBetween(0, 1),
            ]);
        }

        foreach (Period::all() as $period) {
            $courseDetails = CourseDetail::inRandomOrder()->take(rand(1, 10))->pluck('id');
            $period->courseDetails()->attach($courseDetails);
        }
    }
}
