<?php

namespace Database\Seeders;

// use App\Models\User;

use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UserSeeder::class, MaterialCategorySeeder::class, ProductSeeder::class]);
        Material::factory(100)->recycle(MaterialCategory::all())->create();
    }
}
