<?php
namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;

class EmployeesImport implements ToModel, WithHeadingRow, WithUpserts, WithBatchInserts, WithChunkReading
{
    /**
     * Process each row.
     */
    public function model(array $row)
    {
        return new Employee([
            'emp_id' => $row['emp_id'],
            'department' => $row['department'],
            'full_name' => $row['full_name'],
            'company_contractor' => $row['company_contractor'],
            'category' => $row['category'],
            'date_of_joining' => Carbon::createFromFormat('d-m-Y', $row['date_of_joining'])->format('Y-m-d H:i:s'),
            'plant_location' => $row['plant_location'],
            'updated_at' => now(),
        ]);
    }

    /**
     * Define the unique key for upsert.
     */
    public function uniqueBy()
    {
        return 'emp_id';
    }

    /**
     * Optimize batch insert size.
     */
    public function batchSize(): int
    {
        return 10;
    }

    /**
     * Read large files in chunks.
     */
    public function chunkSize(): int
    {
        return 10;
    }
}
