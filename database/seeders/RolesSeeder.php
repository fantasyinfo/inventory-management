<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        $permissions = [
            // store managers
            "create store manager",
            "edit store manager",
            "delete store manager",
            "view store manager",

            // employee
            "create employee",
            "bulk upload employee",
            "update employee",
            "delete employee",
            "view employee",

            // merchandises
            "create merchandise",
            "bulk upload merchandise",
            "update merchandise",
            "delete merchandise",
            "view merchandise",

            // issue merchandises
            "issue merchandise",
            "bulk upload issue merchandise",
            "delete issue merchandise",
            "view issue merchandise",
        ];

        $storeManagerPermission = [
            // store managers
            "view store manager",

            // employee
            "create employee",
            "bulk upload employee",
            "view employee",

            // merchandises
            "view merchandise",

            // issue merchandises
            "issue merchandise",
            "bulk upload issue merchandise",
            "view issue merchandise",
        ];

        // Create permissions if they don't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $storeManagerRole = Role::firstOrCreate(['name' => 'Store Manager']);

        // super admin permissions
        $adminRole->syncPermissions($permissions);
        // stoere manager permissions
        $storeManagerRole->syncPermissions($storeManagerPermission);

        $this->command->info('Roles seeded successfully.');
    }
}
