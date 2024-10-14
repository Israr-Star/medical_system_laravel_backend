<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::post('/registration', [VerificationController::class, 'registration']);
Route::post('/login', [VerificationController::class, 'login']);


Route::post('/cardiologists', [DepartmentController::class, 'viewCardiologists']);
Route::get('/loaddoctor', [DepartmentController::class, 'index']);
Route::get('loaddetails/{id}', [DepartmentController::class, 'loaddetails']);
Route::post('/appointment', [DepartmentController::class, 'appointment']);
Route::get('loadAppointment', [DepartmentController::class, 'loadAppointment']);
Route::delete('delete-appointment/{id}', [DepartmentController::class, 'destroy']);
Route::get('loadAppointment/{id}', [DepartmentController::class, 'loadAppointmentforRechedule']);

Route::put('/update-appointment/{id}', [DepartmentController::class, 'update']);

Route::get('/loadDashboard', [DepartmentController::class, 'loadDashboard']);

Route::post('/saveDepartment', [DepartmentController::class, 'saveDepartment']);

Route::get('/loadDepartment', [DepartmentController::class, 'loadDepartment']);



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
