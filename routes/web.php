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
    Route::get('/campus/school-system', 'getCampusSchoolSystemByCampusId')->name('campus.campusSchoolSystemByCampusId');
    Route::get('/campus/classes', 'getCampusClassesByCampusAndSystemId')->name('campus.CampusClassesByCampusAndSystemId');
    Route::get('/campus/class-groups-and-sections', 'getClassGroupAndSectionByCampusSystemAndClassId')->name('campus.classGroupAndSectionByCampusSystemAndClassId');
    Route::get('/campus/test-inteview-groups-and-class-sections', 'getTestInterviewGroupAndClassSectionByCampusSystemClassId')->name('campus.testInterviewGroupAndClassSectionByCampusSystemClassId');
});

//Admission routes
Route::controller(StudentRegistrationController::class)->group(function () {
    Route::get('/student/registration/add', 'add')->name('student.registration.create');
    Route::post('/student/registration/store', 'store')->name('student.registration.store');
    Route::get('/campus/student/form-id', 'getStudentFormNumberByCampusIdAndSystemIdAndSessionId')->name('campus.studentFormNumberByCampusIdAndSystemIdAndSessionId');
});

//Area routes
Route::controller(AreaController::class)->group(function () {
    Route::get('/area', 'listing')->name('area.view');
    Route::get('/area/add', 'add')->name('area.create');
    Route::post('/area/store', 'store')->name('area.store');
    Route::get('/area/edit/{id}', 'edit')->name('area.edit');
    Route::put('/area/update/{id}', 'update')->name('area.update');
    Route::delete('/area/delete', 'delete')->name('area.delete');
});

//City routes
Route::controller(CityController::class)->group(function () {
    Route::get('/city', 'listing')->name('city.view');
    Route::get('/city/add', 'add')->name('city.create');
    Route::post('/city/store', 'store')->name('city.store');
    Route::get('/city/edit/{id}', 'edit')->name('city.edit');
    Route::put('/city/update/{id}', 'update')->name('city.update');
    Route::delete('/city/delete', 'delete')->name('city.delete');
});

//Class routes
Route::controller(ClassController::class)->group(function () {
    Route::get('/class', 'listing')->name('class.view');
    Route::get('/class/add', 'add')->name('class.create');
    Route::post('/class/store', 'store')->name('class.store');
    Route::get('/class/edit/{id}', 'edit')->name('class.edit');
    Route::put('/class/update/{id}', 'update')->name('class.update');
    Route::delete('/class/delete', 'delete')->name('class.delete');
});

//Group routes
Route::controller(GroupController::class)->group(function () {
    Route::get('/group', 'listing')->name('group.view');
    Route::get('/group/add', 'add')->name('group.create');
    Route::post('/group/store', 'store')->name('group.store');
    Route::get('/group/edit/{id}', 'edit')->name('group.edit');
    Route::put('/group/update/{id}', 'update')->name('group.update');
    Route::delete('/group/delete', 'delete')->name('group.delete');
});

//Section routes
Route::controller(SectionController::class)->group(function () {
    Route::get('/section', 'listing')->name('section.view');
    Route::get('/section/add', 'add')->name('section.create');
    Route::post('/section/store', 'store')->name('section.store');
    Route::get('/section/edit/{id}', 'edit')->name('section.edit');
    Route::put('/section/update/{id}', 'update')->name('section.update');
    Route::delete('/section/delete', 'delete')->name('section.delete');
});

//Admission routes
Route::controller(AdmissionController::class)->group(function () {
    
    Route::get('/admission', 'listing')->name('admission.view');
    Route::get('/admission/add', 'create')->name('admission.create');
    Route::post('/admission/store', 'store')->name('admission.store');
    Route::get('/admission/edit/{id}', 'edit')->name('admission.edit');
    Route::put('/admission/update', 'update')->name('admission.update');
    Route::delete('/admission/delete', 'delete')->name('admission.delete');
    Route::get('/admission/student/details/{id}', 'admissionStudentDetails')->name('student.details');

    Route::post('/search/student', 'searchStudent');
    Route::get('/student/details', 'studentDetails');
    // Route::get('/import', 'import')->name('import');
    Route::get('admission/import', 'import')->name('admission.import');
    Route::post('/admission/import/store', 'importStore')->name('admission.import.store');

    Route::get('/campus/get-system', 'getCampusSystem');
});


Route::any('/dashboard', function() {
    return view('dashboard.index');
})->name('dashboard');

