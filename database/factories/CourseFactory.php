<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /* Elige de 1 a 3 departamentos */
        $dirigido = $this->faker->randomElements([
            'Depto. de Ciencias Básicas',
            'Depto. de Metal Mecánica',
            'Depto. de Sistemas y Computación',
            'Depto. de Ciencias de la Tierra',
            'Depto. de Ingeniería Química',
            'Depto. de Ingeniería Industrial',
            'Depto. de Ingeniería Eléctrica',
            'Depto. de Ingeniería Electrónica',
        ], rand(1, 3));

        return [
            'clave' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{2}'),
            'nombre' => rtrim($this->faker->sentence(3), '.'),
            'objetivo' => rtrim($this->faker->paragraph(), '.'),

            'duracion' => $this->faker->numberBetween(1, 5),
            'observaciones' => rtrim($this->faker->paragraph(), '.'),
            'dirigido' => implode(', ', $dirigido),
            'perfil' => $this->faker->randomElement(['Formación docente', 'Actualización profesional']),
        ];
    }
}
