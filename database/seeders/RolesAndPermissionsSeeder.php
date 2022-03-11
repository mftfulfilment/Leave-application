<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'application.create',
            'application.authorize',
        ];
        foreach($permissions as $permission) Permission::create(['name' => $permission]);
        // =======================================================================

        $admin       = Role::create(['name' => 'admin']);
        $hr     = Role::create(['name' => 'Hr']);
        $department_head = Role::create(['name' => 'department head']);
        $staff   = Role::create(['name' => 'staff']);
        // =======================================================================

        $staff_permissions = [
            'application.create',
        ];

        $admin->syncPermissions($permissions);
        $hr->syncPermissions($permissions);
        $department_head->syncPermissions($permissions);
        $staff->syncPermissions($staff_permissions);
    }
}
