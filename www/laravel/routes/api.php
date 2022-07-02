<?php

use App\Http\Controllers\ApiControllers\AuthController;
use App\Http\Controllers\ApiControllers\OrderController;
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

Route::group(['prefix' => 'v1'], function () {
    Route::namespace('ApiControllers')->group(function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('signup', [AuthController::class, 'signup']);
            Route::post('signin', [AuthController::class, 'signin']);
        });
        Route::group(['middleware' => ['auth.basic']], function () {
            Route::group(['prefix' => 'orders'], function () {
                Route::post('', [OrderController::class, 'store']);
                Route::get('', [OrderController::class, 'show']);
                Route::put('', [OrderController::class, 'update']);
            });
        });
    });
});
