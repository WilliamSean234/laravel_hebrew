<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $drinkNames = [
            'Espresso',
            'Cappuccino',
            'Caramel Macchiato',
            'Lemon Tea',
            'Ice Shaken Espresso',
            'Hot Chocolate',
            'Mineral Water',
        ];

        $minPrice = 10000;
        $maxPrice = 20000;

        $overheadCost = fake()->numberBetween($minPrice - 5000, $minPrice);
        $sellingPrice = fake()->numberBetween($minPrice, $maxPrice);

        return [
            "name" => fake()->randomElement($drinkNames),
            "type" => fake()->randomElement(['latte', 'matcha', 'americano']),
            "size" => fake()->randomElement(['small', 'medium', 'large']),
            "description" => fake()->text(),
            "overhead_cost" => $overheadCost,
            "selling_price" => $sellingPrice,
            "image_path" => fake()->imageUrl(640, 480),


        ];
    }
}
