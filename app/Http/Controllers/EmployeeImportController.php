<?php

namespace App\Http\Controllers;

use App\Exports\MerchandiseIssuesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;
use Illuminate\Support\Facades\Session;

class EmployeeImportController extends Controller
{
    public function showForm()
    {
        return view('employees.import');
    }

    public function import(Request $request)
    {
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
        return view('employees.export');
    }

    public function export(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'format' => 'required|in:csv,xlsx'
        ]);


        // Convert input dates from DD-MM-YYYY to YYYY-MM-DD
        $fromDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->from_date)->format('Y-m-d');
        $toDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->to_date)->format('Y-m-d');


        return Excel::download(new MerchandiseIssuesExport($fromDate, $toDate), "merchandise_issues.{$request->format}");
    }
}
