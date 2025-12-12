<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function scopeFilterName(Builder $query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }
    }

    public function scopeFilterCategory(Builder $query, array $filters)
    {

        // if ($filters['search'] ?? false) {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('type', 'like', '%' . $search . '%');
        });

        // $query->when(
        //     $filters['category'] ?? false,
        //     fn($query, $category) =>
        //     $query->whereHas('category', fn($query) => $query->where('slug', $category))
        // );

        // $query->when($filters[''] ?? false, function ($query,   $search) {});


    }
}
