<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::apiResource('/customers', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::apiResource('/customers',CustomerController::class);
Route::apiResource('/categories',CategoryController::class);
Route::apiResource('/products',ProductController::class);
Route::apiResource('/orders',OrderController::class);
