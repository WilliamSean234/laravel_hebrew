<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

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

Route::get('/create-main', function () {
    return view('create-main');
});
