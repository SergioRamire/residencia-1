<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupAssignment>
 */
class GroupAssignmentFactory extends Factory
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
            'course_detail_id' => $this->faker->numberBetween(1, 10),
            'group_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
