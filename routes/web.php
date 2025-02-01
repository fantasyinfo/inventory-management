<?php

use App\Http\Controllers\EmployeeImportController;
use App\Http\Controllers\MerchandiseImportController;
use App\Livewire\Employees\EmployeeDetail;
use App\Livewire\Employees\Employees;
use App\Livewire\Manager\ManagerDetail;
use App\Livewire\Manager\Managers;
use App\Livewire\Merchandise\AvailableStocks;
use App\Livewire\Merchandise\IssueMerchandises;
use App\Livewire\Merchandise\Merchandise;
use App\Livewire\Merchandise\MerchandiseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');
Route::redirect('/', '/login');


// Correct the group definition
Route::group(['middleware' => ['auth']], function () {
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    // store managers
    Route::get('/managers', Managers::class)->name('managers');

    Route::get('/managers/details/{id}', ManagerDetail::class)->name('managers.details');

    // employees
    Route::get('/employees', Employees::class)->name('employees');

    Route::get('/employees/details/{id}', EmployeeDetail::class)->name('employees.details');

    // merchandise
    Route::get('/merchandise', Merchandise::class)->name('merchandise');
    Route::get('/merchandise/details/{id}', MerchandiseDetail::class)->name('merchandise.details');

    // import & export 
    Route::get('/merchandise/import', [MerchandiseImportController::class, 'showForm'])->name('merchandise.import.form');
    Route::post('/merchandise/import', [MerchandiseImportController::class, 'import'])->name('merchandise.import');

    Route::get('/merchandise/issue/import', [MerchandiseImportController::class, 'showIssueForm'])->name('merchandise.issue.import.form');
    Route::post('/merchandise/issue/import', [MerchandiseImportController::class, 'importIssue'])->name('merchandise.issue.import');

    // issue
    Route::get('/issue-merchandise', IssueMerchandises::class)->name('issue.merchandise');
    Route::get('/available-stocks', AvailableStocks::class)->name('available.stocks');


    // import & export 
    Route::get('/employees/import', [EmployeeImportController::class, 'showForm'])->name('employees.import.form');
    Route::post('/employees/import', [EmployeeImportController::class, 'import'])->name('employees.import');

    Route::get('/employees/export', [EmployeeImportController::class, 'showExportForm'])->name('employees.export.form');
    Route::post('/employees/export', [EmployeeImportController::class, 'export'])->name('employees.export');

});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');




Route::get('/setup', function (Request $request) {
    if ($request->header('X-Setup-Key') !== "fantasyinfofreelancer") {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    // Capture Artisan command output
    $output = [];

    // **Forcefully reset the database and apply fresh migrations**
    $output['migrate_fresh'] = Artisan::call('migrate:fresh --force');

    // **Re-seed the database (force re-insert of data)**
    $output['db_seed'] = Artisan::call('db:seed --force');

    // **Re-optimize Laravel**
    $output['config_cache'] = Artisan::call('config:cache');
    $output['route_cache'] = Artisan::call('route:cache');
    $output['view_cache'] = Artisan::call('view:cache');
    $output['optimize'] = Artisan::call('optimize');

    // Log the output
    info('Setup Command Output:', $output);

    return response()->json([
        'message' => 'Setup completed successfully (Forced Data Refresh)',
        'output' => $output
    ]);
});

# curl -H "X-Setup-Key: fantasyinfofreelancer" https://inventory.fantasyinfo.cloud/setup

require __DIR__ . '/auth.php';
