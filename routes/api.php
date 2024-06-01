<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::apiResource('/customers', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::apiResource('/customers',CustomerController::class);
Route::apiResource('/categories',CategoryController::class);
