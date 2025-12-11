<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    $products = Product::latest()->get();
    return view('overview', [
        'products' => $products,
    ]);
});

Route::get('/create-main', function () {
    return view('create-main');
});