<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Group;
use App\Models\Period;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoursesDetail>
 */
class CourseDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $hora_inicio = $this->faker->time('H:i');

        $lugares = $this->faker->randomElement([
            'Sala Audivisual, Edificio I',
            'I10','I12','F1','F2','F3','F4','F5','F6',
            'K1','K2','K3','K4','K5','K6',
            'Sala Audivisual, Edificio B','Sala Audivisual, Edificio A',
            'Laboratorio de inge civil',
            'Centro de computo','H2','H3','H4','H5','H6',
        ]);

        return [
            'hora_inicio' => $hora_inicio,
            'hora_fin' => date('H:i', strtotime($hora_inicio.'+1 hour')),
            'lugar' => $lugares,
            'capacidad' => $this->faker->numberBetween(10, 30),
            'modalidad' => $this->faker->randomElement(['Presencial', 'Semi-presencial', 'En linea']),
            'course_id' => Course::inRandomOrder()->first()->id,
            'group_id' => Group::inRandomOrder()->first()->id,
            'period_id' => Period::inRandomOrder()->first()->id,
        ];
    }
}
