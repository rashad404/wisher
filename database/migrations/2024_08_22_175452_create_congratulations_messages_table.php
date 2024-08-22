<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongratulationsMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('congratulations_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('important_date_id')->constrained()->onDelete('cascade');
            $table->foreignId('important_date_category_id')->constrained()->onDelete('cascade');
            $table->string('language');
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('congratulations_messages');
    }
}
