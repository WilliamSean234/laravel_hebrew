<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\MaterialCategory;
use App\Models\Recipe;
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
        // Product::create([
        //     'name' => fake()->name(),
        //     'type' => 'test',
        //     'size' => 'test',
        //     'description' => 'test',
        //     'overhead_cost' => fake()->numberBetween(2000, 9000),
        //     'selling_price' => fake()->numberBetween(10000, 20000),
        //     'image_path' => fake()->address(),

        //     // 'name' => $request->name,
        //     // 'type' => $request->type,
        //     // 'size' => $request->size,
        //     // 'description' => $request->description,
        //     // 'overhead_cost' => $request->overhead_cost,
        //     // 'selling_price' => $request->selling_price,
        //     // 'image_path' => $request->image_path,
        // ]);

        // Recipe::create([
        //     'product_id' => Product::latest()->first()->id,
        // ]);



        // Validasi dasar
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
            'ingredient_name' => 'required|array', // Pastikan ada minimal 1 bahan
        ]);

        try {
            DB::beginTransaction(); // Memulai transaksi database

            // 1. Simpan data ke tabel Products
            // Pastikan Anda sudah menambahkan fillable di model Product
            $product = Product::create([
                'name' => $request->name,
                'type' => $request->type,
                'size' => $request->size,
                'description' => $request->description,
                'overhead_cost' => $request->overhead_cost,
                'selling_price' => $request->selling_price,
                'image_path' => $request->image_path,
            ]);

            // 2. Simpan data ke tabel Recipes (Multiple Rows)
            $materials            = $request->ingredient_name; // Ini berisi array material_id
            $ingredient_recipes   = $request->ingredient_recipe;
            $unit_of_measures     = $request->unit_of_measure;
            $ingredient_costs     = $request->ingredient_cost;
            $ingredient_total_costs = $request->ingredient_total_cost;

            foreach ($materials as $key => $material_id) {
                // Hanya simpan jika material_id tidak kosong
                if (!empty($material_id)) {
                    Recipe::create([
                        'product_id'            => $product->id, // Mengambil ID produk yang baru saja dibuat
                        'material_id'           => $material_id,
                        'ingredient_recipe'     => $ingredient_recipes[$key],
                        'unit_of_measure'       => $unit_of_measures[$key],
                        'ingredient_cost'       => $ingredient_costs[$key],
                        'ingredient_total_cost' => $ingredient_total_costs[$key],
                    ]);
                }
            }
            DB::commit(); // Simpan permanen jika semua berhasil (success)
            return redirect('/')->with('success', 'New product and recipes successfully added');
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika ada error (failure)
            dd($e->getMessage());
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }


        //setelah data berhasil ditambah
        // return redirect('/')->with('success', 'ne w product successfully added');
    }
}
