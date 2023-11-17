<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('main_image')->nullable();
            $table->text('extra_images')->nullable(); // Store as JSON
            $table->string('condition')->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('discounted_price', 8, 2)->nullable();
            $table->string('sku')->unique()->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->text('features')->nullable(); // Store as JSON
            $table->timestamps();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
            $table->foreignId('product_model_id')->nullable()->constrained('product_models')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
