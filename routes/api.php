<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Маршруты для отделов
Route::get('/departments', [DepartmentController::class, 'get']);
Route::post('/departments', [DepartmentController::class, 'store']);
Route::delete('/departments', [DepartmentController::class, 'destroy']);

// Маршруты для сотрудников
Route::get('/employees', [EmployeeController::class, 'get']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
