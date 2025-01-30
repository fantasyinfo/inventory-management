<?php

namespace App\Imports;

use App\Models\Merchandise;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MerchandiseImport implements ToModel, WithHeadingRow, WithUpserts, WithBatchInserts, WithChunkReading
{
    /**
     * Process each row.
     */
    public function model(array $row)
    {
        return new Merchandise([
            'sku' => $row['sku'],
            'item_name' => $row['item_name'],
            'supplier_name' => $row['supplier_name'],
            'brand_make' => $row['brand_make'],
            'qty' => $row['qty'],
            'cost_per_item' => $row['cost_per_item'],
            'date_of_purchase' => $row['date_of_purchase'],
            'plant_location' => $row['plant_location'],
            'store_number' => $row['store_number'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Define the unique key for upsert.
     */
    public function uniqueBy()
    {
        return 'sku';
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
