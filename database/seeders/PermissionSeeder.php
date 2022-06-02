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

        Permission::create(['name' => 'user.show', 'human_name' => 'Visualizar usuarios'])->assignRole(['Administrador']);
        Permission::create(['name' => 'user.create', 'human_name' => 'Crear usuarios'])->assignRole(['Administrador']);
        Permission::create(['name' => 'user.edit', 'human_name' => 'Editar usuarios'])->assignRole(['Administrador']);
        Permission::create(['name' => 'user.delete', 'human_name' => 'Eliminar usuarios'])->assignRole(['Administrador']);

        Permission::create(['name' => 'course.show', 'human_name' => 'Visualizar cursos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'course.create', 'human_name' => 'Crear cursos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'course.edit', 'human_name' => 'Editar cursos'])->assignRole(['Administrador']);
        Permission::create(['name' => 'course.delete', 'human_name' => 'Eliminar cursos'])->assignRole(['Administrador']);

        Permission::create(['name' => 'participant.show', 'human_name' => 'Visualizar participantes'])->assignRole(['Administrador']);
        Permission::create(['name' => 'participant.edit', 'human_name' => 'Editar participantes'])->assignRole(['Administrador']);

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
