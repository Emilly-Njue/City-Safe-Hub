<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CrimeReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddOfficerController;
use App\Http\Controllers\OfficerController;




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

// Add Officers
Route::get('admin/add_officers/{id}/delete', [AddOfficerController::class, 'destroy']);
Route::resource('admin/add_officers', AddOfficerController::class);

// Officers
Route::get('admin/officers/{id}/delete', [OfficerController::class, 'destroy']);
Route::resource('admin/officers', OfficerController::class);

// Report Crime(Admin)
Route::get('admin/crime/{id}/delete', [CrimeReportController::class, 'destroy']);
Route::resource('admin/crime', CrimeReportController::class);

// Assign Officer to Crime
Route::post('admin/crime/assign-officer/{id}', [CrimeReportController::class, 'assignOfficer']);
Route::post('admin/crime/{id}/assign', [CrimeReportController::class, 'assignOfficer'])->name('crime.assign');
