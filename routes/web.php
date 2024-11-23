<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\FinanceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'bo', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'staff'], function () {
        Route::get('/', [StaffController::class, 'index'])->name('staff.index');
    });

    Route::group(['prefix' => 'finance'], function () {
        Route::get('/', [FinanceController::class, 'index'])->name('finance.index');
    });
});
