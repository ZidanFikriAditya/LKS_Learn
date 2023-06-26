<?php

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


Route::prefix('v1')->name('v1.')->group(function (){
   Route::post('login', [\App\Http\Controllers\api\Auth\AuthController::class, 'login']);

    Route::middleware('custom-auth')->group(function () {
        Route::post('logout', [\App\Http\Controllers\api\Auth\AuthController::class, 'logout']);
        Route::apiResource('consultations', \App\Http\Controllers\api\ConsultationController::class);
    });
});
