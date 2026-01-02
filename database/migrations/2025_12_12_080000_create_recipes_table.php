<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained(
                table: 'materials',
                indexName: 'material_id'
            );
            $table->foreignId('product_id')->constrained(
                table: 'products',
                indexName: 'product_id'
            );
            $table->string('ingredient_recipe');
            $table->string('unit_of_measure');
            $table->bigInteger('ingredient_cost');
            $table->bigInteger('ingredient_total_cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
