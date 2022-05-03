<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $nombre = $this->faker->firstName();
        $apellido_paterno = $this->faker->lastName();
        $correo_id = $nombre.'.'.$apellido_paterno;
        $hora_entrada = $this->faker->time();

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'apellido_materno' => $this->faker->lastName(),
            'apellido_paterno'=> $apellido_paterno,
            'rfc' => $this->faker->regexify('/[A-Z]{3,4}\d{2}0[1-9]2\d[A-Z0-9]{2}[A0-9]/'),
            'curp' => $this->faker->regexify('/[A-Z][AEIOUX][A-Z]{2}\d{2}0[1-9]2\d[HM][A-Z]{2}[B-DF-HJ-NP-TV-Z]{3}[A-Z\d]\d/'),
            'tipo' => $this->faker->randomElement(['Base', 'Interinato', 'Honorarios']),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'carrera' => $this->faker->randomElement([
                'Ingeniería Electrónica',
                'Ingeniería Civil',
                'Ingeniería Mecánica',
                'Ingeniería Industrial',
                'Ingeniería Química',
                'Ingeniería Eléctrica',
                'Ingeniería en Gestión Empresarial',
                'Ingeniería en Sistemas Computacionales',
                'Ingeniería en Administración',]),
            'clave_presupuestal' => $this->faker->regexify('[0-9A-Z]{30}'),
            'organizacion_origen' => $this->faker->sentence(1),
            'estudio_maximo' => $this->faker->sentence(),
            'cuenta_moodle' => $this->faker->numberBetween(0, 1),
            'puesto' => $this->faker->jobTitle(),
            'hora_entrada' => $hora_entrada,
            'hora_salida' => date('H:i:s', strtotime($hora_entrada.'+5 hour')),
            'correo_tecnm' => $correo_id.'@oaxaca.tecnm.mx',
            'area_id' => $this->faker->numberBetween(1, 8),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
