<?php

namespace App\Http\Controllers;


use App\Imports\IssueMerchandiseImport;
use App\Imports\MerchandiseImport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class MerchandiseImportController extends Controller
{
    use AuthorizesRequests; // Ensure this is included

    public function showForm()
    {
        if (auth()->user()->can('bulk upload merchandise')) {
            // User has permission, allow action
            return view('merchandise.import');
        } else {
            abort(403, 'Unauthorized action.');
        }

    }

    public function import(Request $request)
    {
        $this->authorize('bulk upload merchandise');

        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048'
        ]);

        try {
            Excel::import(new MerchandiseImport, $request->file('file'));

            // Set success message in session for UI feedback
            Session::flash('success', 'Merchandises imported successfully!');
        } catch (\Exception $e) {
            Session::flash('error', 'Error importing file. Please check the format.');
        }

        return back();
    }


    public function showIssueForm()
    {
        if (auth()->user()->can('bulk upload issue merchandise')) {
            // User has permission, allow action
            return view('merchandise.import-issue');
        } else {
            abort(403, 'Unauthorized action.');
        }

    }


    public function importIssue(Request $request)
    {
        $this->authorize('bulk upload issue merchandise');
        try {
            // Validate File
            $request->validate([
                'file' => 'required|mimes:xlsx,csv,txt|max:5120' // Increased to 5MB
            ]);

            // Import the file
            Excel::import(new IssueMerchandiseImport, $request->file('file'));

            // Success Message
            Session::flash('success', 'Merchandises issued imported successfully!');
        } catch (\Exception $e) {
            // Log Detailed Error
            info('File Import Error: ' . $e->getMessage(), [
                'file' => $request->file('file')
            ]);

            // Error Message
            Session::flash('error', 'Error importing file. Please check the format.');
        }

        return back();
    }

}
