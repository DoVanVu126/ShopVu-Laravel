<?php

use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('cart', CartController::class);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('orders', OrdersController::class);
});

Route::apiResource('categories', CategoriesController::class);
Route::apiResource('brands', BrandsController::class);
Route::apiResource('products', ProductsController::class);
