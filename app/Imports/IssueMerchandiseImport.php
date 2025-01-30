<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\IssueMerchandise;
use App\Models\Merchandise;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;
class IssueMerchandiseImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
     * Process each row.
     */
    public function model(array $row)
    {

        // Fetch the Employee ID
        $employeeId = Employee::where('emp_id', $row['emp_id'])->value('id');
        if (!$employeeId) {
            return null; // Skip row if employee not found
        }

        // Fetch the Merchandise ID
        $merchandise = Merchandise::where('sku', $row['sku'])->first();
        if (!$merchandise) {
            return null; // Skip row if merchandise not found
        }

        // Check if enough stock is available
        if ($row['qty'] > $merchandise->qty) {
            return null; // Skip row if requested qty exceeds available stock
        }



        $merchandise->update([
            'qty' => (int) $merchandise->qty - (int) $row['qty']
        ]);


        return new IssueMerchandise([
            'employee_id' => $employeeId,
            'merchandise_id' => $merchandise->id,
            'issued_by' => Auth::id(),
            'qty' => $row['qty'],
            'issue_date' => Carbon::createFromFormat('d-m-Y', $row['issue_date'])->format('Y-m-d H:i:s'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
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
