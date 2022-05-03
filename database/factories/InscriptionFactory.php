<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscription>
 */
class InscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'calificacion' => $this->faker->numberBetween(0, 100),
            'estatus' => $this->faker->randomElement(['Participante', 'Instructor']),
            'asistencias_minimas' => $this->faker->numberBetween(0, 1),
            'coursesdetail_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
