<?php
namespace App\Exports;

use App\Models\IssueMerchandise;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MerchandiseIssuesExport implements FromCollection, WithHeadings
{
    protected $fromDate;
    protected $toDate;

    public function __construct($fromDate, $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function collection()
    {

        $data = IssueMerchandise::whereBetween('issue_date', [$this->fromDate, $this->toDate])
            ->with(['employee', 'merchandise', 'issuedBy'])
            ->get()
            ->map(function ($issue) {
                return [
                    'ID' => $issue->id,
                    'Item Name' => $issue->merchandise?->item_name ?? 'N/A', // Get item name from merchandise relationship
                    'Issue Date' => Carbon::parse($issue->issue_date)->format('d-m-Y'),
                    'Quantity' => $issue->qty,
                    'Issued Employee' => $issue->employee?->full_name . "( ".$issue->employee?->emp_id ." )" ?? 'N/A',
                    'Issued By (Manager)' => $issue->issuedBy?->name ?? 'N/A', // Get name from issuedBy relationship
                ];
            });

        return $data;
    }

    public function headings(): array
    {
        return ["ID", "Item Name", "Issue Date", "Quantity", "Issued Employee", "Issued By (Manager)"];
    }
}
