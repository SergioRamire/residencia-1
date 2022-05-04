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

        /* Crea todos los permisos */
        $permissions = [
            'user_show',
            'user_create',
            'user_edit',
            'user_delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        /* Crea roles */

        // Rol super-admin obtiene todos los permisos por medio de Gate:before -> AuthServiceProvider
        $superAdminRole = Role::create(['name' => 'super-admin']);

        $adminRole = Role::create(['name' => 'admin']);
        $instructorRole = Role::create(['name' => 'instructor']);
        $participantRole = Role::create(['name' => 'participant']);

        /* Asignación de permisos a roles */
        $adminPermissions = [
            'user_show',
            'user_create',
            'user_edit',
            'user_delete',
        ];
        $adminRole->givePermissionTo($adminPermissions);

        /* Asignación de roles a 9 usuarios */
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
