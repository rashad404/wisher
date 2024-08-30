<?php
// database/migrations/xxxx_xx_xx_create_categories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // Storing name in JSON format for multi-language support
            $table->json('desc')->nullable(); // Optional description in JSON format
            $table->boolean('status')->default(1); // Active status by default
            $table->integer('sort_order')->default(0); // Default sort order
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade'); // Parent ID for subcategories
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
