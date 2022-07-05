<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//System routes
Route::controller(SystemController::class)->group(function () {
    Route::get('/system/add', 'add')->name('system.create');
    Route::post('/system/store', 'store')->name('system.store');
});

//Campus routes
Route::controller(CampusController::class)->group(function () {
    Route::get('/campus/add', 'add')->name('campus.create');
    Route::post('/campus/store', 'store')->name('campus.store');
});


//Admission routes
Route::controller(RegistrationController::class)->group(function () {
    Route::get('/student/registration/add', 'add')->name('student.registration.create');
    Route::post('/student/registration/store', 'store')->name('student.registration.store');
});


Route::any('/dashboard', function() {
    return view('dashboard.index');
})->name('dashboard');