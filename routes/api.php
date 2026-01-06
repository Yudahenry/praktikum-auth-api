<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

// ====================
// SESUAI MODUL HALAMAN 3: REST API ROUTES
// ====================

// Versi 1: Menggunakan apiResource (sesuai modul)
Route::apiResource('products', ProductController::class);

// Versi 2: Manual routes (juga sesuai modul)
// Route::get('/products', [ProductController::class, 'index']);
// Route::get('/products/{id}', [ProductController::class, 'show']);
// Route::post('/products', [ProductController::class, 'store']);
// Route::put('/products/{id}', [ProductController::class, 'update']);
// Route::delete('/products/{id}', [ProductController::class, 'destroy']);