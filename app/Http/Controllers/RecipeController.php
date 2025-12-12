<?php

namespace App\Http\Controllers;

use App\Models\MaterialCategory;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function getRecipeRow(Request $request)
    {
        $categories = MaterialCategory::all();
        return view('components.recipe-row', [
            'categories' => $categories
        ]);
    }
}
