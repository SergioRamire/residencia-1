<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'clave' => $this->faker->unique()->randomNumber('4', true),
            'nombre' => $this->faker->unique()->randomElement([
                'Depto. de Ciencias Básicas',
                'Depto. de Metal Mecánica',
                'Depto. de Sistemas y Computación',
                'Depto. de Ciencias de la Tierra',
                'Depto. de Ingeniería Química',
                'Depto. de Ingeniería Industrial',
                'Depto. de Ingeniería Eléctrica',
                'Depto. de Ingeniería Electrónica',
            ]),
            'jefe_area' => $this->faker->name(),
            'telefono' => $this->faker->regexify('951[0-9]{3}[0-9]{4}'),
            'extension' => $this->faker->randomNumber('3', true),
        ];
    }
}
