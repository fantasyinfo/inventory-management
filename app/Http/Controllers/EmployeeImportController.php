<?php 

namespace App\Http\Controllers;

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
}
