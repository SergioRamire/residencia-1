<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Group;
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

        $hora_inicio = $this->faker->time();

        return [
            'hora_inicio' => $hora_inicio,
            'hora_fin' => date('H:i:s', strtotime($hora_inicio.'+1 hour')),
            'lugar' => rtrim($this->faker->sentence(2), '.'),
            'capacidad' => $this->faker->numberBetween(10, 30),
            'course_id' => Course::inRandomOrder()->first()->id,
            'group_id' => Group::inRandomOrder()->first()->id,
        ];
    }
}
