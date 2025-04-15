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

Route::group(["prefix"=> "departments"], function () {
    Route::get('/', [DepartmentController::class, 'get']);
    Route::post('/store', [DepartmentController::class, 'store']);
    Route::delete('/destroy', [DepartmentController::class, 'destroy']);
    Route::put('/update', [DepartmentController::class, 'update']);
});

Route::group(["prefix"=> "employees"], function () {
    Route::get('/', [EmployeeController::class, 'get']);
    Route::post('/store', [EmployeeController::class, 'store']);
    Route::delete('/destroy', [EmployeeController::class, 'destroy']);
    Route::put('/update', [EmployeeController::class, 'update']);
});
