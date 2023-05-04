<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/get-products', App\Http\Controllers\Api\ProdukController::class);

Route::apiResource('/get-users', App\Http\Controllers\Api\UserController::class);