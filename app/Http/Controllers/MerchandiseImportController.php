<?php

namespace App\Http\Controllers;


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



}
