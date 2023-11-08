<?php

use App\Http\Controllers\User\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::group(['prefix' => 'user'], function () {
    Route::post('/auth/register', [AuthController::class, 'create']);
    Route::post('/auth/login', [AuthController::class, 'login'])->middleware('throttle:5,1');;
    Route::group(['middleware' => ['assignGuard:web', 'auth:sanctum', 'role:Customer']], function () {
        Route::put('/changePassword/{id}', [AuthController::class, 'changePassword']);
        Route::put('/updateProfileDetails/{id}', [AuthController::class, 'updateProfileDetails']);
        Route::post('/logout', [AuthController::class, 'logout']);
        //my Routes
    });
});
