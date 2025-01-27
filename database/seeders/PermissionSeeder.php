<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Restablece los roles y permisos en caché
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Creación de roles
        |--------------------------------------------------------------------------
        */

        // Rol super-admin obtiene todos los permisos por medio de Gate:before -> AuthServiceProvider
        $superAdminRole = Role::create(['name' => 'Super admin']);

        $adminRole = Role::create(['name' => 'Administrador']);
        $jefadepto = Role::create(['name' => 'Jefa de departamento']);
        $instructorRole = Role::create(['name' => 'Instructor']);
        $participantRole = Role::create(['name' => 'Participante']);
        $coordinadorRole = Role::create(['name' => 'Coordinador']);

        /*
        |--------------------------------------------------------------------------
        | Creación de permisos
        |--------------------------------------------------------------------------
        */
        Permission::create(['name' => 'role.show', 'human_name' => 'Ver roles'])->assignRole(['Administrador','Coordinador']);
        Permission::create(['name' => 'role.create', 'human_name' => 'Crear roles'])->assignRole(['Administrador','Coordinador']);
        Permission::create(['name' => 'role.edit', 'human_name' => 'Editar roles'])->assignRole(['Administrador','Coordinador']);
        Permission::create(['name' => 'role.delete', 'human_name' => 'Eliminar roles'])->assignRole(['Administrador']);

        Permission::create(['name' => 'profile.show', 'human_name' => 'Ver Perfil'])->assignRole(['Administrador','Instructor','Participante', 'Jefa de departamento']);
        Permission::create(['name' => 'profile.edit', 'human_name' => 'Editar Perfil'])->assignRole(['Administrador','Instructor','Participante', 'Jefa de departamento']);

        Permission::create(['name' => 'user.show', 'human_name' => 'Ver usuarios'])->assignRole(['Administrador','Coordinador']);
        Permission::create(['name' => 'user.create', 'human_name' => 'Crear usuarios'])->assignRole(['Administrador','Coordinador']);
        Permission::create(['name' => 'user.edit', 'human_name' => 'Editar usuarios'])->assignRole(['Administrador','Coordinador']);
        Permission::create(['name' => 'user.delete', 'human_name' => 'Eliminar usuarios'])->assignRole(['Administrador','Coordinador']);

        Permission::create(['name' => 'studying.show', 'human_name' => 'Ver cursos inscritos'])->assignRole(['Participante']);
        Permission::create(['name' => 'teaching.show', 'human_name' => 'Ver cursos a impartir'])->assignRole(['Instructor']);

        Permission::create(['name' => 'area.show', 'human_name' => 'Ver areas'])->assignRole(['Administrador','Coordinador']);
        Permission::create(['name' => 'area.create', 'human_name' => 'Crear areas'])->assignRole(['Administrador','Coordinador']);
        Permission::create(['name' => 'area.edit', 'human_name' => 'Editar areas'])->assignRole(['Administrador','Coordinador']);
        Permission::create(['name' => 'area.delete', 'human_name' => 'Eliminar areas'])->assignRole(['Administrador','Coordinador']);

        Permission::create(['name' => 'course.show', 'human_name' => 'Ver cursos'])->assignRole(['Administrador', 'Jefa de departamento','Coordinador']);
        Permission::create(['name' => 'course.create', 'human_name' => 'Crear cursos'])->assignRole(['Administrador', 'Jefa de departamento','Coordinador']);
        Permission::create(['name' => 'course.edit', 'human_name' => 'Editar cursos'])->assignRole(['Administrador', 'Jefa de departamento','Coordinador']);
        Permission::create(['name' => 'course.delete', 'human_name' => 'Eliminar cursos'])->assignRole(['Administrador', 'Jefa de departamento','Coordinador']);

        Permission::create(['name' => 'participant.show', 'human_name' => 'Ver participantes'])->assignRole(['Administrador']);
        Permission::create(['name' => 'participant.edit', 'human_name' => 'Editar participantes'])->assignRole(['Administrador']);

        Permission::create(['name' => 'instructor.show', 'human_name' => 'Ver instructores'])->assignRole(['Administrador']);

        Permission::create(['name' => 'coursedetails.show', 'human_name' => 'Ver detalles cursos'])->assignRole(['Administrador', 'Jefa de departamento','Coordinador']);
        Permission::create(['name' => 'coursedetails.create', 'human_name' => 'Crear detalles cursos'])->assignRole(['Administrador', 'Jefa de departamento','Coordinador']);
        Permission::create(['name' => 'coursedetails.edit', 'human_name' => 'Editar detalles cursos'])->assignRole(['Administrador', 'Jefa de departamento','Coordinador']);
        Permission::create(['name' => 'coursedetails.delete', 'human_name' => 'Eliminar detalles cursos'])->assignRole(['Administrador', 'Jefa de departamento','Coordinador']);

        Permission::create(['name' => 'inscription.create', 'human_name' => 'Inscripción a curso'])->assignRole(['Participante']);
        Permission::create(['name' => 'inscription.select', 'human_name' => 'Seleccionar curso'])->assignRole(['Participante']);

        Permission::create(['name' => 'period.show', 'human_name' => 'Ver periodos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'period.create', 'human_name' => 'Crear periodos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'period.edit', 'human_name' => 'Editar periodos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'period.delete', 'human_name' => 'Eliminar periodos'])->assignRole(['Administrador']);

        Permission::create(['name' => 'group.show', 'human_name' => 'Ver grupos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'group.create', 'human_name' => 'Crear grupos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'group.edit', 'human_name' => 'Editar grupos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'group.delete', 'human_name' => 'Eliminar grupos'])->assignRole(['Administrador']);

        Permission::create(['name' => 'assigninstructor.show', 'human_name' => 'Ver instructores'])->assignRole(['Administrador']);
        Permission::create(['name' => 'assigninstructor.assign', 'human_name' => 'Asignar instructor'])->assignRole(['Administrador']);
        Permission::create(['name' => 'assigninstructor.delete', 'human_name' => 'Eliminar instructor'])->assignRole(['Administrador']);

        Permission::create(['name' => 'participantlists.show', 'human_name' => 'Ver listas'])->assignRole(['Administrador', 'Jefa de departamento']);
        Permission::create(['name' => 'participantlists.create', 'human_name' => 'Crear listas'])->assignRole(['Administrador', 'Jefa de departamento']);
        Permission::create(['name' => 'participantlists.edit', 'human_name' => 'Editar listas'])->assignRole(['Administrador', 'Jefa de departamento']);
        Permission::create(['name' => 'participantlists.delete', 'human_name' => 'Eliminar listas'])->assignRole(['Administrador', 'Jefa de departamento']);

        Permission::create(['name' => 'qualification.show', 'human_name' => 'Ver calificaciones'])->assignRole(['Instructor']);
        Permission::create(['name' => 'qualification.edit', 'human_name' => 'Editar calificaciones'])->assignRole(['Instructor']);

        Permission::create(['name' => 'constancy.show', 'human_name' => 'Consultar constancias'])->assignRole(['Administrador', 'Jefa de departamento']);
        Permission::create(['name' => 'constancy.download', 'human_name' => 'Descargar constancias'])->assignRole(['Administrador', 'Jefa de departamento']);

        Permission::create(['name' => 'constancyInstructor.show', 'human_name' => 'Consultar constancias instructor'])->assignRole(['Administrador', 'Jefa de departamento']);
        Permission::create(['name' => 'constancyInstructor.download', 'human_name' => 'Descargar constancias instructor'])->assignRole(['Administrador', 'Jefa de departamento']);

        Permission::create(['name' => 'limitAsignGrades.edit', 'human_name' => 'Establecer fecha limite'])->assignRole(['Jefa de departamento','Coordinador']);

        Permission::create(['name' => 'backup.show', 'human_name' => 'Ver respaldos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'backup.create', 'human_name' => 'Crear respaldo'])->assignRole(['Administrador']);
        Permission::create(['name' => 'backup.download', 'human_name' => 'Descargar respaldo'])->assignRole(['Administrador']);
        Permission::create(['name' => 'backup.delete', 'human_name' => 'Eliminar respaldo'])->assignRole(['Administrador']);
        Permission::create(['name' => 'backup.restore', 'human_name' => 'Restaurar respaldo'])->assignRole(['Administrador']);

        Permission::create(['name' => 'historycourse.show', 'human_name' => 'Historial cursos'])->assignRole(['Administrador', 'Jefa de departamento']);
        Permission::create(['name' => 'historyparticipant.show', 'human_name' => 'Historial Participantes'])->assignRole(['Administrador', 'Jefa de departamento']);
        Permission::create(['name' => 'historyinstructor.show', 'human_name' => 'Historial Instructores'])->assignRole(['Administrador', 'Jefa de departamento']);

        Permission::create(['name' => 'activeinscription.show', 'human_name' => 'Vista Activar Inscripcion'])->assignRole(['Administrador', 'Jefa de departamento']);
        Permission::create(['name' => 'activeinscription.edit', 'human_name' => 'Activar/Desactivar inscripciones'])->assignRole(['Administrador', 'Jefa de departamento']);

        Permission::create(['name' => 'sendemail.show', 'human_name' => 'Vista emails'])->assignRole(['Administrador', 'Jefa de departamento']);
        Permission::create(['name' => 'sendnotify.show', 'human_name' => 'Ver notificaciones'])->assignRole(['Administrador', 'Jefa de departamento']);
        Permission::create(['name' => 'sendnotify.create', 'human_name' => 'Crear notificaciones'])->assignRole(['Jefa de departamento']);
        Permission::create(['name' => 'sendnotify.delete', 'human_name' => 'Eliminar notificaciones'])->assignRole(['Jefa de departamento']);
        Permission::create(['name' => 'notify.show', 'human_name' => 'Inspeccionar notificaciones'])->assignRole(['Instructor', 'Participante']);

        Permission::create(['name' => 'const_firmada.show', 'human_name' => 'Ver constacias firmadas'])->assignRole(['Administrador', 'Jefa de departamento']);

        /*
        |--------------------------------------------------------------------------
        | Asignación de roles a usuarios (Primeros 9)
        |--------------------------------------------------------------------------
        */

        $users = User::all();
        $users->get(0)->assignRole($superAdminRole);
        $users->get(1)->assignRole($instructorRole);
        $users->get(2)->assignRole($participantRole);
        $users->get(3)->assignRole($coordinadorRole);
        // $users->get(4)->assignRole($instructorRole);
        // $users->get(5)->assignRole($instructorRole);
        // $users->get(6)->assignRole($participantRole);
        // $users->get(7)->assignRole($participantRole);
        // $users->get(8)->assignRole($participantRole);
    }
}

