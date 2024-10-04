<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,"login"]);
    Route::post('logout', [AuthController::class,"logout"]);
    Route::post('refresh', [AuthController::class,"refresh"]);
    Route::post('me', [AuthController::class,"me"]);

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'stock'

], function ($router) {

    Route::post('get', [StockController::class,"get"]);
    Route::post('create', [StockController::class,"create"]);
    Route::post('update', [StockController::class,"update"]);
    Route::post('delete', [StockController::class,"delete"]);

});
