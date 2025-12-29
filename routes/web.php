<?php

use App\Models\Product;
use App\Models\MaterialCategory;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    // return view('welcome');
    // $products = Product::latest()->get();
    // dump(request('search'));
    // $products = Product::latest()->paginate(5)->withQueryString();

    $products = Product::latest();


    return view('overview', [
        'products_count' => $products->filterName(request(['search']))->get()->count(),
        'products' => $products->filterName(request(['search']))->latest()->paginate(10)->withQueryString()
    ]);
});

// ===========================================
// 2. ROUTE UNTUK HALAMAN TAMBAH PRODUK (Full Page View)
// ===========================================
Route::get('/create-main', function () {
    $product_category = MaterialCategory::latest()->get();

    return view('create-main', [
        'product_category' => $product_category,
    ]);
})->name('product.create');


Route::get('/sales-main', function () {
    return view('sales-main');
});
