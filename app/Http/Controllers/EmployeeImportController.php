<?php

namespace App\Http\Controllers;

use App\Exports\MerchandiseIssuesExport;
use App\Models\Employee;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;
use Illuminate\Support\Facades\Session;

class EmployeeImportController extends Controller
{

    use AuthorizesRequests; // Ensure this is included

    public function showForm()
    {
        if (auth()->user()->can('bulk upload employee')) {
            // User has permission, allow action
            return view('employees.import');
        } else {
            abort(403, 'Unauthorized action.');
        }

    }

    public function import(Request $request)
    {
        $this->authorize('bulk upload employee');

        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048'
        ]);

        try {
            Excel::import(new EmployeesImport, $request->file('file'));

            // Set success message in session for UI feedback
            Session::flash('success', 'Employees imported successfully!');
        } catch (\Exception $e) {
            Session::flash('error', 'Error importing file. Please check the format.');
        }

        return back();
    }

    public function showExportForm()
    {
        $employees = Employee::where('status','active')->get();

        return view('employees.export', [
            'employees' => $employees,
        ]);
    }

    public function export(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'format' => 'required|in:csv,xlsx',
            'employee_id' => 'nullable|exists:employees,id'
        ]);


  
        // Convert input dates from DD-MM-YYYY to YYYY-MM-DD
        $fromDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->from_date)->format('Y-m-d');
        $toDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->to_date)->format('Y-m-d');

        $employeeId = $request->employee_id;

        return Excel::download(new MerchandiseIssuesExport($fromDate, $toDate, $employeeId), "merchandise_issues.{$request->format}");
    }
}
