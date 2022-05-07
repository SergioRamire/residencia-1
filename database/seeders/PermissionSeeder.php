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
        $superAdminRole = Role::create(['name' => 'super-admin']);

        $adminRole = Role::create(['name' => 'admin']);
        $instructorRole = Role::create(['name' => 'instructor']);
        $participantRole = Role::create(['name' => 'participant']);

        /*
        |--------------------------------------------------------------------------
        | Creación de permisos
        |--------------------------------------------------------------------------
        */
        Permission::create(['name' => 'rol.show', 'human_name' => 'Visualizar roles'])->assignRole(['admin']);
        Permission::create(['name' => 'rol.create', 'human_name' => 'Crear roles'])->assignRole(['admin']);
        Permission::create(['name' => 'rol.edit', 'human_name' => 'Editar roles'])->assignRole(['admin']);
        Permission::create(['name' => 'rol.delete', 'human_name' => 'Eliminar roles'])->assignRole(['admin']);

        Permission::create(['name' => 'user.show', 'human_name' => 'Visualizar usuarios'])->assignRole(['admin']);
        Permission::create(['name' => 'user.create', 'human_name' => 'Crear usuarios'])->assignRole(['admin']);
        Permission::create(['name' => 'user.edit', 'human_name' => 'Editar usuarios'])->assignRole(['admin']);
        Permission::create(['name' => 'user.delete', 'human_name' => 'Eliminar usuarios'])->assignRole(['admin']);

        // Permission::create(['name' => 'course.show', 'human_name' => 'Visualizar cursos'])->assignRole(['admin', 'instructor']);
        // Permission::create(['name' => 'course.create', 'human_name' => 'Crear cursos'])->assignRole(['admin', 'instructor']);
        // Permission::create(['name' => 'course.edit', 'human_name' => 'Editar cursos'])->assignRole(['admin']);
        // Permission::create(['name' => 'course.delete', 'human_name' => 'Eliminar cursos'])->assignRole(['admin']);

        /*
        |--------------------------------------------------------------------------
        | Asignación de roles a usuarios (Primeros 9)
        |--------------------------------------------------------------------------
        */
        $users = User::all();
        $users->get(0)->assignRole($superAdminRole);
        $users->get(1)->assignRole($adminRole);
        $users->get(2)->assignRole($adminRole);
        $users->get(3)->assignRole($instructorRole);
        $users->get(4)->assignRole($instructorRole);
        $users->get(5)->assignRole($instructorRole);
        $users->get(6)->assignRole($participantRole);
        $users->get(7)->assignRole($participantRole);
        $users->get(8)->assignRole($participantRole);
    }
}
