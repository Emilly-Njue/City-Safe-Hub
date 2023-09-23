<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CrimeReportController;
use App\Http\Controllers\AdminController;


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

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Service page
Route::get('services', [ServiceController::class, 'service'])->name('services');

// report a crime page
Route::get('report_crime', [CrimeReportController::class, 'reportcrime'])->name('crime-report');
Route::post('report_crime', [CrimeReportController::class, 'store'])->name('crime-report.store');

// Admin
Route::get('admin', [AdminController::class, 'admin'])->name('admin');
Route::get('admin/login', [AdminController::class, 'login']);
Route::post('admin/login', [AdminController::class, 'check_login']);
Route::get('admin/logout', [AdminController::class, 'logout']);
