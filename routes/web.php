<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\CampusController;

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
    Route::get('/system', 'listing')->name('system.view');
    Route::get('/system/add', 'add')->name('system.create');
    Route::post('/system/store', 'store')->name('system.store');
    Route::get('/system/edit/{id}', 'edit')->name('system.edit');
    Route::put('/system/update/{id}', 'update')->name('system.update');
    Route::delete('/system/delete', 'delete')->name('system.delete');
});

//Campus routes
Route::controller(CampusController::class)->group(function () {
    Route::get('/campus', 'listing')->name('campus.view');
    Route::get('/campus/add', 'add')->name('campus.create');
    Route::post('/campus/store', 'store')->name('campus.store');
    Route::get('/campus/edit/{id}', 'edit')->name('campus.edit');
    Route::put('/campus/update/{id}', 'update')->name('campus.update');
    Route::delete('/campus/delete', 'delete')->name('campus.delete');
});

Route::any('/dashboard', function() {
    // return "I am here..";
    return view('dashboard.index');
})->name('dashboard');