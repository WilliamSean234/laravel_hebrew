<?php

namespace Database\Factories;

use App\Models\MaterialCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $minPrice = 10000;
        $maxPrice = 20000;

        $purchasePrice = fake()->numberBetween($minPrice, $maxPrice);

        return [
            "name" => fake()->name(),
            "category_id" => MaterialCategory::factory(),
            "suplier" => fake()->name(),
            "purchase_price" => $purchasePrice,

        ];
    }
}
