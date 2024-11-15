<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $roles = ['admin', 'customer', 'technician', 'staff'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Create permissions
        $permissions = [
            'manage roles',
            'manage users',
            'manage products',
            'view products',
            'create products',
            'edit products',
            'delete products',
            'manage tasks',
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            // Add more permissions as needed
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Retrieve admin role
        $adminRole = Role::where('name', 'admin')->first();

        // Assign all permissions to admin role
        $allPermissions = Permission::all();
        $adminRole->syncPermissions($allPermissions);
    }
}
