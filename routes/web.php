<?php


use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');
Route::redirect('/', '/login');


// Correct the group definition
Route::group(['middleware' => ['auth']], function () {
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');


});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
