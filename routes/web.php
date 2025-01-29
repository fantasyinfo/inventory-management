<?php

use App\Livewire\Employees\EmployeeDetail;
use App\Livewire\Employees\Employees;
use App\Livewire\Manager\ManagerDetail;
use App\Livewire\Manager\Managers;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');
Route::redirect('/', '/login');


// Correct the group definition
Route::group(['middleware' => ['auth']], function () {
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    // store managers
    Route::get('/managers',Managers::class)->name('managers');

    Route::get('/managers/details/{id}', ManagerDetail::class)->name('managers.details');
    
    // employees
    Route::get('/employees',Employees::class)->name('employees');

    Route::get('/employees/details/{id}', EmployeeDetail::class)->name('employees.details');


});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
