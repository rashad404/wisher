<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingPlansTable extends Migration
{
    public function up()
    {
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->decimal('price_monthly', 8, 2)->nullable(); // Allow NULL
            $table->decimal('price_yearly', 8, 2)->nullable(); // Allow NULL
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('pricing_plans');
    }
}
