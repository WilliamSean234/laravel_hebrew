<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\MaterialCategory;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{



    // SHOW ALL PRODUCT
    public function showAll()
    {
        // return view('welcome');
        // $products = Product::latest()->get();
        // dump(request('search'));
        // $products = Product::latest()->paginate(5)->withQueryString();

        $products = Product::latest();


        return view('overview', [
            'products_count' => $products->filterName(request(['search']))->get()->count(),
            'products' => $products->filterName(request(['search']))->latest()->paginate(10)->withQueryString()
        ]);
    }

    // MOVE TO CREATE PRODUCT PAGE
    public function createPage()
    {
        $material_category = MaterialCategory::latest()->get();
        $materials = Material::orderBy('name', 'asc')->get();

        return view('create-main', [
            'materials' => $materials,
            'material_categories' => $material_category,
        ]);
    }

    public function storeNewProduct(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'type' => 'required',
        //     'size' => 'required',
        //     'description' => 'required',
        //     'overhead_cost' => 'required',
        //     'selling_price_input' => 'required',
        //     'image_path' => 'required',
        // ]);

        // menyimpan data ke database

        // cara menggunakan querry builder
        // DB::table("products")->create([]);

        //query tambah data
        Product::create([
            'name' => fake()->name(),
            'type' => 'test',
            'size' => 'test',
            'description' => 'test',
            'overhead_cost' => fake()->numberBetween(2000, 9000),
            'selling_price' => fake()->numberBetween(10000, 20000),
            'image_path' => fake()->address(),

            // 'name' => $request->name,
            // 'type' => $request->type,
            // 'size' => $request->size,
            // 'description' => $request->description,
            // 'overhead_cost' => $request->overhead_cost,
            // 'selling_price' => $request->selling_price,
            // 'image_path' => $request->image_path,
        ]);
        //setelah data berhasil ditambah
        return redirect('/')->with('success', 'new product successfully added');
    }
}
