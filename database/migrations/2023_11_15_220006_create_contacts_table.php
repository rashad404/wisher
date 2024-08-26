<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('registered_user_id')->nullable(); // Link to registered user if exists
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('birthdate')->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->json('interests')->nullable();
            $table->json('likes')->nullable();
            $table->json('dislikes')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('registered_user_id')->references('id')->on('users')->onDelete('set null'); // Set null if the registered user is deleted
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
