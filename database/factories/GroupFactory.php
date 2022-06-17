<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nombre = $this->faker->randomElement([
            'ISA','ISB','ISC','LAA','LAS','LASB','IGA','IGS', 'ICA','ICB','ICC','III','HAK'
        ]);
        return [
            // 'nombre' => rtrim($this->faker->sentence(1), '.'),
            'nombre'=> $nombre,
        ];
    }
}
