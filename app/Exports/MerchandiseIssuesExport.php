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
    protected $employeeId;

    public function __construct($fromDate, $toDate, $employeeId = null)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->employeeId = $employeeId;
    }

    public function collection()
    {
        // Base Query
        $query = IssueMerchandise::whereBetween('issue_date', [$this->fromDate, $this->toDate])
            ->with(['employee', 'merchandise', 'issuedBy']);

        // Apply Employee ID Filter (Only if provided)
        if (!is_null($this->employeeId)) {
            $query->whereHas('employee', function ($q) {
                $q->where('id', $this->employeeId);
            });
        }

        // Get Data & Transform
        $data = $query->get()->map(function ($issue) {
            return [
                'ID' => $issue->id,
                'Item Name' => $issue->merchandise?->item_name ?? 'N/A', // Get item name
                'Issue Date' => Carbon::parse($issue->issue_date)->format('d-m-Y'),
                'Quantity' => $issue->qty,
                'Issued Employee' => $issue->employee 
                    ? "{$issue->employee->full_name} ({$issue->employee->emp_id})"
                    : 'N/A',
                'Issued By (Manager)' => $issue->issuedBy?->name ?? 'N/A',
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return ["ID", "Item Name", "Issue Date", "Quantity", "Issued Employee", "Issued By (Manager)"];
    }
}
