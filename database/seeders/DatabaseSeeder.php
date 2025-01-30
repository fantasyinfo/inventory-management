<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Super Admin user
        $superAdmin = User::firstOrCreate([
            'email' => 'super@admin.com',
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password123'), // Change this to a secure password
        ]);

        // Run the RolesSeeder
        $this->call(RolesSeeder::class);

        // Assign the "Super Admin" role to the user
        $superAdmin->assignRole('Super Admin');

        $this->command->info('Super Admin user created and assigned role successfully.');
    }
}
