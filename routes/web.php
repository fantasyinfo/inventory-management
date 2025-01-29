<?php

use App\Livewire\Employees\EmployeeDetail;
use App\Livewire\Employees\Employees;
use App\Livewire\Manager\ManagerDetail;
use App\Livewire\Manager\Managers;
use App\Livewire\Merchandise\AvailableStocks;
use App\Livewire\Merchandise\IssueMerchandises;
use App\Livewire\Merchandise\Merchandise;
use App\Livewire\Merchandise\MerchandiseDetail;
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
    // issue
    Route::get('/issue-merchandise', IssueMerchandises::class)->name('issue.merchandise');
    Route::get('/available-stocks', AvailableStocks::class)->name('available.stocks');


});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
