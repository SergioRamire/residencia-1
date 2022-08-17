<?php

namespace Database\Factories;

use App\Models\Area;
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
        // $nombre = $this->faker->firstName();
        // $apellido_paterno = $this->faker->lastName();

        $hora_entrada = $this->faker->time('H:i');

        $nombre1 = $this->faker->randomElement([
            'Sergio','Saul','Valentina','Regina','Camila','Maria','Fernanda','Maria','Valeria','Renata','Victoria','Maria','Expropiasion', 'Juana','Arturo','Alexis','Carmen','Alejandro','Alejandra','Mareli','Natali',
            'Concha','Natalia', 'Mareli', 'MariaBD','Mateo','Sebastian','Emiliano','Diego','Miguel','angel','Daniel','Daniela',
            'Jesus', 'Pedro','Emiliano','Gael', 'David', 'Marco','Farid', 'Erik', 'Pablo','Santiago','Leonardo','Victoria', 'Andre','Manuel', 'Martin', 'Perla', 'Rebecca','Izmucaneth', 'Abimael','Maricela', 'Francisco',
        ]);
        $nombre2 = $this->faker->randomElement([
            'Sergio','Saul','Valentina','Regina','Camila','Maria','Fernanda','Maria','Valeria','Renata','Victoria','Maria','Expropiasion', 'Juana','Arturo','Alexis','Carmen','Alejandro','Alejandra','Mareli','Natali',
            'Concha','Natalia', 'Mareli', 'MariaBD','Mateo','Sebastian','Emiliano','Diego','Miguel','angel','Daniel','Daniela',
            'Jesus', 'Pedro','Emiliano','Gael', 'David', 'Marco','Farid', 'Erik', 'Pablo','Santiago','Leonardo','Victoria', 'Andre','Manuel', 'Martin', 'Perla', 'Rebecca','Izmucaneth', 'Abimael','Maricela', 'Francisco',
        ]);

        $apellido_paterno = $this->faker->randomElement([
            'Lopez','Garcia','Hernandez','Gonzalez','Perez','Rodriguez', 'Sanchez','Ramirez','Cruz','Gomez','Flores','Morales',
            'Vazquez','Reyes','Torres','Jimenez','Diaz','Gutierrez','Mendoza','Ruiz','Ortiz','Aguilar','Moreno','Castillo','alvarez','Zarate', 'Anaya','Juarez','Suarez','Dominguez','Ramos','Herrera','Medina','Castro','Guzman'
        ]);

        $apellido_materno = $this->faker->randomElement([
            'Lopez','Garcia','Hernandez','Gonzalez','Perez','Rodriguez', 'Sanchez','Ramirez','Cruz','Gomez','Flores','Morales',
            'Vazquez','Reyes','Torres','Jimenez','Diaz','Gutierrez','Mendoza','Ruiz','Ortiz','Aguilar','Moreno','Castillo','alvarez','Zarate', 'Anaya','Juarez','Suarez','Dominguez','Ramos','Herrera','Medina','Castro','Guzman'
        ]);

        $correo_id = strtolower($this->faker->randomNumber(8));
        $correoito=$this->faker->randomElement([
            'itoaxaca.edu.mx',
        ]);
        $carrera=$this->faker->randomElement([
                'Ingeniería Electronica',
                'Ingeniería Civil',
                'Ingeniería Mécanica',
                'Ingeniería Industrial',
                'Ingeniería Química',
                'Ingeniería Electrica',
                'Ingeniería en Gestión Empresarial',
                'Ingeniería en Sistemas Computacionales',
                'Ingeniería en Administración','Licenciando en Administracion','Contador publico','Fisico matematico',
        ]);

        $organizacion=$this->faker->randomElement([
            'Tecnologico de oaxaca',
            'Cisco','Fundacion Carlos Slim'
        ]);

        $jefein=$this->faker->randomElement([
            'Dr. Ruben Doroteo Castillejos',
            'M.A. Efren Normando Enriquez Porras',
            'M.C. Maricela Morales Hernández',
            'M.A. Edgar Alberto Cortes Jimenez',
            'M.C. Minerva Donají Mendez López',
            'M.C. Martha Hilaria Bartolo Aleman',
            'Ing. Adrian Gómez Ordaz',
            'Ing. Roberto Tamar Castellanos Baltazar',
            'José Alfredo Reyes Juárez',
            'L.I. Virginia Ortíz Mendez',
        ]);

        $estudiosmax=$this->faker->randomElement([
            'Licenciatura', 'Maestria','Doctorado',
        ]);


        return [
            'name' =>"$nombre1 $nombre2",
            'email' => "$correo_id@$correoito",
            'email_verified_at' => now(),
            'password' => '$2y$10$8iSktfH9.QnYrwARdz9DGOVQw9CD0Gub06RpQOfARENujzShxMnw2', // 12345678
            'remember_token' => Str::random(10),
            'apellido_materno' => $apellido_materno,
            'apellido_paterno'=> $apellido_paterno,
            'rfc' => $this->faker->regexify('/^[A-Z&]{3,4}\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])([A-Z0-9]{2})([A0-9])$/'),
            'curp' => $this->faker->regexify('/[A-Z][AEIOUX][A-Z]{2}\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])[HM](AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z0-9]\d/'),
            'tipo' => $this->faker->randomElement(['Base', 'Interinato', 'Honorarios']),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'carrera' => $carrera,
            'clave_presupuestal' => $this->faker->regexify('[0-9A-Z]{15}'),
            'organizacion_origen' => $organizacion,
            'estudio_maximo' => $estudiosmax,
            'cuenta_moodle' => $this->faker->numberBetween(0, 1),
            'puesto_en_area' => $this->faker->jobTitle(),
            'jefe_inmediato' => $jefein,
            'hora_entrada' => $hora_entrada,
            'hora_salida' => date('H:i', strtotime($hora_entrada.'+5 hour')),
            'correo_tecnm' => "$correo_id@oaxaca.tecnm.mx",
            'area_id' => Area::inRandomOrder()->first()->id,
            'estatus'=>'1',
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
