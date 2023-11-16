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
            $table->unsignedBigInteger('user_id'); // Assuming you have a users table
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('birthdate')->nullable();
            $table->text('address')->nullable();
            $table->json('interests')->nullable();
            $table->json('likes')->nullable();
            $table->json('dislikes')->nullable();
            $table->timestamps();

            // Define foreign key relationship with the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
