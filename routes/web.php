<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
// use App\Models\Product;
// use App\Models\MaterialCategory;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\RecipeController;


// ===========================================
// 2. ROUTE UNTUK HALAMAN TAMBAH PRODUK (Full Page View)
// ===========================================
Route::get('/', [ProductController::class, 'showAll']);
Route::get('/create-main', [ProductController::class, 'createPage']);
Route::post('/create-main', [ProductController::class, 'storeNewProduct']); // Menambah produk baru ke table products


Route::get('/sales-main', function () {
    return view('sales-main');
});
