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

Route::get('login', function () {
    return response()->json([
       'message' => 'Token not valid'
    ], 401);
})->name('login');

Route::post('login', [\App\Http\Controllers\Api\Auth\AuthenticateController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [\App\Http\Controllers\Api\Auth\AuthenticateController::class, 'logout']);

    Route::get('user', function () {
        return [
            'oyo'
        ];
    });
});
