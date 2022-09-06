<?php

namespace Database\Seeders;

use App\Models\CourseDetail;
use App\Models\Period;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('course_details')->insert([
            'hora_inicio' => '08:00',
            'hora_fin' => '09:00',
            'lugar' => 'I10',
            'capacidad' => 30,
            'modalidad' => 'Presencial',
            'course_id' => 1,
            'group_id' => 1,
            'period_id' => 1,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '09:00',
            'hora_fin' => '10:00',
            'lugar' => 'I12',
            'capacidad' => 30,
            'modalidad' => 'Presencial',
            'course_id' => 2,
            'group_id' => 1,
            'period_id' => 1,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '10:00',
            'hora_fin' => '11:00',
            'lugar' => 'I14',
            'capacidad' => 30,
            'modalidad' => 'Presencial',
            'course_id' => 3,
            'group_id' => 1,
            'period_id' => 1,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '11:00',
            'hora_fin' => '12:00',
            'lugar' => 'I16',
            'capacidad' => 30,
            'modalidad' => 'Presencial',
            'course_id' => 4,
            'group_id' => 1,
            'period_id' => 1,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '12:00',
            'hora_fin' => '13:00',
            'lugar' => 'I18',
            'capacidad' => 30,
            'modalidad' => 'En linea',
            'course_id' => 5,
            'group_id' => 2,
            'period_id' => 2,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '13:00',
            'hora_fin' => '14:00',
            'lugar' => 'I20',
            'capacidad' => 30,
            'modalidad' => 'En linea',
            'course_id' => 6,
            'group_id' => 2,
            'period_id' => 2,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '14:00',
            'hora_fin' => '15:00',
            'lugar' => 'I22',
            'capacidad' => 30,
            'modalidad' => 'En linea',
            'course_id' => 7,
            'group_id' => 2,
            'period_id' => 2,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '08:30',
            'hora_fin' => '09:30',
            'lugar' => 'I11',
            'capacidad' => 30,
            'modalidad' => 'En linea',
            'course_id' => 1,
            'group_id' => 2,
            'period_id' => 1,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '09:30',
            'hora_fin' => '10:30',
            'lugar' => 'I13',
            'capacidad' => 30,
            'modalidad' => 'En linea',
            'course_id' => 2,
            'group_id' => 2,
            'period_id' => 1,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '10:30',
            'hora_fin' => '11:30',
            'lugar' => 'I15',
            'capacidad' => 30,
            'modalidad' => 'En linea',
            'course_id' => 3,
            'group_id' => 2,
            'period_id' => 1,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '11:30',
            'hora_fin' => '12:30',
            'lugar' => 'I17',
            'capacidad' => 30,
            'modalidad' => 'Presencial',
            'course_id' => 5,
            'group_id' => 1,
            'period_id' => 2,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '12:30',
            'hora_fin' => '13:30',
            'lugar' => 'I19',
            'capacidad' => 30,
            'modalidad' => 'Presencial',
            'course_id' => 6,
            'group_id' => 1,
            'period_id' => 2,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '13:30',
            'hora_fin' => '14:30',
            'lugar' => 'I21',
            'capacidad' => 30,
            'modalidad' => 'Presencial',
            'course_id' => 7,
            'group_id' => 1,
            'period_id' => 2,
            'estatus' => '1',
        ]);

        DB::table('course_details')->insert([
            'hora_inicio' => '14:30',
            'hora_fin' => '15:30',
            'lugar' => 'I23',
            'capacidad' => 30,
            'modalidad' => 'Presencial',
            'course_id' => 8,
            'group_id' => 1,
            'period_id' => 2,
            'estatus' => '1',
        ]);

        $i = 0;
        foreach (CourseDetail::all() as $courseDetail) {
            if ($courseDetail->id === 41)
                break;

            $users = User::skip($i)->take(10)->pluck('id');
            $courseDetail->users()->attach($users, [
                'calificacion' => 0,
                'estatus_participante' => 'Participante',
                'asistencias_minimas' => $faker->numberBetween(0, 1),
                'url_cedula' => '',
            ]);
            $i += 10;
        }

        /*foreach (User::all() as $user) {
            $faker = Factory::create();
            $courseDetails = CourseDetail::inRandomOrder()->take(rand(1, 2))->pluck('id');
            $user->courseDetails()->attach($courseDetails, [
                'calificacion' => 0,
                'estatus_participante' => $faker->randomElement(['Participante', 'Instructor']),
                'asistencias_minimas' => $faker->numberBetween(0, 1),
                'url_cedula' => '',
            ]);
        }*/

        /* foreach (Period::all() as $period) {
            $courseDetails = CourseDetail::inRandomOrder()->take(rand(1, 10))->pluck('id');
            $period->courseDetails()->attach($courseDetails);
        } */
    }
}
