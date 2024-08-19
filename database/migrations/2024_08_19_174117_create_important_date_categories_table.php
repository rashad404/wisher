<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportantDateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('important_date_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('position');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('important_date_categories');
    }
}
