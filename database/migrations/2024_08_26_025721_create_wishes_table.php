<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishesTable extends Migration
{
    public function up()
    {
        Schema::create('wishes', function (Blueprint $table) {
            $table->id();
            $table->string('lang', 10); // Language code, e.g., 'en', 'az'
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wishes');
    }
}
