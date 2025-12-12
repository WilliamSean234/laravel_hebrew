<?php

namespace Database\Seeders;

use App\Models\MaterialCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaterialCategory::create(
            [
                "name" => "Bahan Baku",
            ]
        );
        MaterialCategory::create(
            [
                "name" => "Kemasan",
            ]
        );
        MaterialCategory::create(
            [
                "name" => "Aksesories",
            ]
        );
        MaterialCategory::create(
            [
                "name" => "Lainnya",
            ]
        );
    }
}
