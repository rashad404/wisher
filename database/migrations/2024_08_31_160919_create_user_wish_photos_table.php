<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWishPhotosTable extends Migration
{
    public function up()
    {
        Schema::create('user_wish_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('wish_photo_template_id')->constrained()->onDelete('cascade');
            $table->json('customization_data');
            $table->string('final_image_path')->nullable();
            $table->boolean('is_public')->default(false);
            $table->unsignedInteger('likes')->default(0);
            $table->unsignedInteger('shares')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_wish_photos');
    }
}