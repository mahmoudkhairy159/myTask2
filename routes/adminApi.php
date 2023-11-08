<?php

use App\Http\Controllers\Admin\Api\CompanyController;
use App\Http\Controllers\Admin\Api\EmployeeController;
use App\Http\Controllers\Admin\Api\UserController;
use App\Http\Controllers\Admin\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| adminAPI Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::group(['prefix' => 'admin', 'middleware' => ['checkLanguage']], function () {
    Route::post('/auth/register', [AuthController::class, 'create']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::group(['middleware' => ['assignGuard:adminApi', 'auth:sanctum']], function () {
        Route::put('/changePassword/{id}', [AuthController::class, 'changePassword']);
        Route::put('/updateProfileDetails/{id}', [AuthController::class, 'updateProfileDetails']);
        Route::get('/showProfileDetails/{id}', [AuthController::class, 'showProfileDetails']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::apiResource('users', UserController::class);
        Route::apiResource('companies', CompanyController::class);
        Route::apiResource('employees', EmployeeController::class);

    });
});
