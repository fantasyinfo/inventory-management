<?php
namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Employee([
            'emp_id' => $row['emp_id'],
            'department' => $row['department'],
            'full_name' => $row['full_name'],
            'company_contractor' => $row['company_contractor'],
            'category' => $row['category'],
            'date_of_joining' => $row['date_of_joining'],
            'plant_location' => $row['plant_location'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

