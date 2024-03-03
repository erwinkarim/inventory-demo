<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;


class RoleNPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $manageUser = Permission::create(['name' => 'manage users']);
        $createInv = Permission::create(['name' => 'create inventory']);
        $editInv = Permission::create(['name' => 'edit inventory']);
        $deleteInv = Permission::create(['name' => 'delete inventory']);

        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $adminRole -> givePermissionTo($manageUser);
        $adminRole -> givePermissionTo($createInv);
        $adminRole -> givePermissionTo($editInv);
        $adminRole -> givePermissionTo($deleteInv);

        //should run after creating admin user
        User::where('email', 'admin@example.com') -> first() -> assignRole('admin');
    }
}
