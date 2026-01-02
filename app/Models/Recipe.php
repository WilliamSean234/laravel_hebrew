<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;

    protected $with = ['material_id', 'product_id']; // Eager Loading by Default


    protected $fillable = [
        'material_id',
        'product_id',
        'ingredient_recipe',
        'unit_of_measure',
        'ingredient_cost',
        'ingredient_total_cost',
    ];
}
