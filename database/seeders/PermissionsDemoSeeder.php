<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'branch']);
        $role1->givePermissionTo('create');
        $role1->givePermissionTo('edit');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('delete');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'username' => 'branch',
            'email' => 'test@example.com',
            'password' => \Hash::make('123456'),
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => \Hash::make('123456'),
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Ali Raza Marchal',
            'username' => 'Super-Admin',
            'email' => 'kh.marchal@gmail.com',
            'password' => \Hash::make('123456'),
        ]);
        $user->assignRole($role3);
    }
}
