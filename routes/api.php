<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/user', 'App\Http\Controllers\UserController@create');

Route::post('/login', 'App\Http\Controllers\AuthController@login');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', 'App\Http\Controllers\AuthController@getUserFromToken');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('/employees', 'App\Http\Controllers\EmployeeController@store');
    Route::get('/employees', 'App\Http\Controllers\EmployeeController@index');
    Route::get('/employees/{employee}', 'App\Http\Controllers\EmployeeController@show');
});

