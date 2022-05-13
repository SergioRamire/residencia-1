<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PeriodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /* Fecha entre 1 de junio al 30 de junio del 2022 */
        $fechaInicio = $this->faker->unique()->dateTimeBetween('2022-06-01', '2022-06-30')->format('Y-m-d');

        /* Utilizado en $fecha_fin = $fecha_inicio + (4|5|6|7|8) dias */
        $fechaMasDias = rand(4, 8);

        return [
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => date('Y-m-d', strtotime($fechaInicio."+${fechaMasDias} day")),
        ];
    }
}
