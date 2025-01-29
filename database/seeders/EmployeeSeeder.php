<?php

namespace Database\Seeders;

use App\Enums\CompanyContractorsTypes;
use App\Enums\DepartmentTypes;
use App\Enums\PlantsLocations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;



class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $employees = [];

        for ($i = 0; $i < 100; $i++) {
            array_push($employees, [
                'emp_id' => $faker->unique()->numberBetween(1000, 9999),
                'department' => DepartmentTypes::random(),
                'full_name' => $faker->name(),
                'company_contractor' => CompanyContractorsTypes::random(),
                'category' => 'permanent',
                'date_of_joining' => $faker->date(),
                'plant_location' => PlantsLocations::random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('employees')->insert($employees);
    }
}
