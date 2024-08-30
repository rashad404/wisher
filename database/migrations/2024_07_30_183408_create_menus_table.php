<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('desc');
            $table->string('url')->nullable(); // URL can be local or external
            $table->boolean('status')->default(1); // Active by default
            $table->integer('sort_order')->default(0); // For sorting
            $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade')->after('url'); // Parent menu for submenus
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
