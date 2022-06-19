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
        $instructorRole = Role::create(['name' => 'Instructor']);
        $participantRole = Role::create(['name' => 'Participante']);

        /*
        |--------------------------------------------------------------------------
        | Creación de permisos
        |--------------------------------------------------------------------------
        */
        Permission::create(['name' => 'role.show', 'human_name' => 'Visualizar roles'])->assignRole(['Administrador']);
        Permission::create(['name' => 'role.create', 'human_name' => 'Crear roles'])->assignRole(['Administrador']);
        Permission::create(['name' => 'role.edit', 'human_name' => 'Editar roles'])->assignRole(['Administrador']);
        Permission::create(['name' => 'role.delete', 'human_name' => 'Eliminar roles'])->assignRole(['Administrador']);

        Permission::create(['name' => 'profile.show', 'human_name' => 'Visualizar Perfil'])->assignRole(['Administrador','Instructor','Participante']);

        Permission::create(['name' => 'user.show', 'human_name' => 'Visualizar usuarios'])->assignRole(['Administrador']);
        Permission::create(['name' => 'user.create', 'human_name' => 'Crear usuarios'])->assignRole(['Administrador']);
        Permission::create(['name' => 'user.edit', 'human_name' => 'Editar usuarios'])->assignRole(['Administrador']);
        Permission::create(['name' => 'user.delete', 'human_name' => 'Eliminar usuarios'])->assignRole(['Administrador']);

        Permission::create(['name' => 'studying.show', 'human_name' => 'Visualizar cursos seleccionados'])->assignRole(['Instructor','Participante']);

        Permission::create(['name' => 'area.show', 'human_name' => 'Visualizar areas'])->assignRole(['Administrador']);
        Permission::create(['name' => 'area.create', 'human_name' => 'Crear areas'])->assignRole(['Administrador']);
        Permission::create(['name' => 'area.edit', 'human_name' => 'Editar areas'])->assignRole(['Administrador']);
        Permission::create(['name' => 'area.delete', 'human_name' => 'Eliminar areas'])->assignRole(['Administrador']);

        Permission::create(['name' => 'course.show', 'human_name' => 'Visualizar cursos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'course.create', 'human_name' => 'Crear cursos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'course.edit', 'human_name' => 'Editar cursos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'course.delete', 'human_name' => 'Eliminar cursos'])->assignRole(['Administrador']);

        Permission::create(['name' => 'participant.show', 'human_name' => 'Visualizar participantes'])->assignRole(['Administrador']);
        Permission::create(['name' => 'participant.edit', 'human_name' => 'Editar participantes'])->assignRole(['Administrador']);

        Permission::create(['name' => 'instructor.show', 'human_name' => 'Visualizar instructores'])->assignRole(['Administrador']);

        Permission::create(['name' => 'coursedetails.show', 'human_name' => 'Visualizar detalles cursos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'coursedetails.create', 'human_name' => 'Crear detalles cursos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'coursedetails.edit', 'human_name' => 'Editar detalles cursos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'coursedetails.delete', 'human_name' => 'Eliminar detalles cursos'])->assignRole(['Administrador']);

        Permission::create(['name' => 'inscription.create', 'human_name' => 'Inscribirse'])->assignRole(['Participante']);

        Permission::create(['name' => 'period.show', 'human_name' => 'Visualizar periodos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'period.create', 'human_name' => 'Crear periodos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'period.edit', 'human_name' => 'Editar periodos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'period.delete', 'human_name' => 'Eliminar periodos'])->assignRole(['Administrador']);

        Permission::create(['name' => 'group.show', 'human_name' => 'Visualizar grupos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'group.create', 'human_name' => 'Crear grupos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'group.edit', 'human_name' => 'Editar grupos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'group.delete', 'human_name' => 'Eliminar grupos'])->assignRole(['Administrador']);

        Permission::create(['name' => 'assigninstructor.show', 'human_name' => 'Visualizar detalles a asignar'])->assignRole(['Administrador']);
        Permission::create(['name' => 'assigninstructor.assign', 'human_name' => 'Asignar instructor'])->assignRole(['Administrador']);

        Permission::create(['name' => 'participantlists.show', 'human_name' => 'Visualizar listas'])->assignRole(['Administrador']);

        Permission::create(['name' => 'qualification.edit', 'human_name' => 'Editar calificaciones'])->assignRole(['Instructor']);

        Permission::create(['name' => 'constancy.show', 'human_name' => 'Consultar constancias'])->assignRole(['Administrador']);
        
        Permission::create(['name' => 'historycourse.show', 'human_name' => 'Historial cursos'])->assignRole(['Administrador']);
        /*
        |--------------------------------------------------------------------------
        | Asignación de roles a usuarios (Primeros 9)
        |--------------------------------------------------------------------------
        */
        $users = User::all();
        $users->get(0)->assignRole($superAdminRole);
        $users->get(1)->assignRole($instructorRole);
        $users->get(2)->assignRole($participantRole);
        // $users->get(3)->assignRole($instructorRole);
        // $users->get(4)->assignRole($instructorRole);
        // $users->get(5)->assignRole($instructorRole);
        // $users->get(6)->assignRole($participantRole);
        // $users->get(7)->assignRole($participantRole);
        // $users->get(8)->assignRole($participantRole);
    }
}
