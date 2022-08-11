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
                'Departamento de Ciencias Básicas',
                'Departamento de Metal Mecánica',
                'Departamento de Sistemas y Computación',
                'Departamento de Ciencias de la Tierra',
                'Departamento de Ingeniería Química',
                'Departamento de Ingeniería Industrial',
                'Departamento de Ingeniería Eléctrica',
                'Departamento de Ingeniería Electrónica',
                'Departamento de Ciencias Económico Administrativas',
                'Departamento de Desarrollo Académico',
        ], rand(1, 3));
        $nombres = $this->faker->randomElement([
            'Elaboración de Manuales de Practica',
            'Diplomado formación de practica',
            'Diplomado en formación y desarrollo de competencias docentes',
            'Comunicación asertiva',
            'Desarrollo de indicadores para competencias especificas en ciencias basicas',
            'Diplomado formación de tutores. Modulo IV',
            'Introducción a la plataforma moodle',
            'Introducción a la programación Matlab',
            'Entorno Matlab, matrices y vectores, graficaas, funciones logicas y estruturas de control',
            'Introducción al SOLIDWORK',
            'Teoría  y aplicacion de los teoremas integrales del calculo vectorial',
            'Google classroom',
            'Solarimetría',
            'Metodología para el desarrollo de prácticas de laboratorio',
            'Diseño de estrategías de enseñanza-aprendizaje en ambientes virtuales',
            'Inteligencia emocional en la Educación en Línea',
            'Curso-taller: Modelo de evaluación del Sistema Nacional de Posgrado',
            'Informe de Residencia Profesional',
            'Metrología',
            'Curso Taller de introducción al perfil deseable y cuerpos académicos',
            'Libre Office',
            'Curso básico de Solidworks',
            'GeoGebra para la enseñanza de cálculo',
        ]);

        $verbo=$this->faker->randomElement([
            'Elaborar', 'Conocer', 'Identificar', 'Proporcionar', 'Practicar', 'Analizar', 'Utilizar', 'Definir', 'Potencializar', 'Actualización', 'Diseñar',
        ]);

        $obj=$this->faker->randomElement([
            'estrategias', 'necesidades', 'programas', 'mecanismos', 'herramientas', 'recursos', 'entornos', 'tecnologias',
        ]);

        $pre=$this->faker->randomElement([
            'para alumnos', 'para optimizar el aprendizaje', 'sustentables', 'que permita la actualizacion', 'para identificar problemas',
        ]);

        return [
            'clave' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{2}'),
            'nombre' => $nombres,
            'objetivo' =>"$verbo $obj $pre",
            'duracion' => $this->faker->numberBetween(1, 5),
            'observaciones' => '',
            'estatus'=>'1',
            'dirigido' => implode(', ', $dirigido),
            'perfil' => $this->faker->randomElement(['Formación docente', 'Actualización profesional']),
        ];
    }
}
