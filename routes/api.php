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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user/profile', [\App\Http\Controllers\Api\User\UserController::class, 'profile']);
    Route::get('user/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::post('user/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('user/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
