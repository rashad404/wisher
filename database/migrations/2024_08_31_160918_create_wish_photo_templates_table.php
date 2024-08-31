<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishPhotoTemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('wish_photo_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('image_path');
            $table->json('editable_areas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wish_photo_templates');
    }
}