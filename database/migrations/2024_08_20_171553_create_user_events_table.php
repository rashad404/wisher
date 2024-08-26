<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEventsTable extends Migration
{
    public function up()
    {
        Schema::create('user_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Add user_id field
            $table->string('name');
            $table->date('date');
            $table->string('recurrence')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('contact_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key for user_id
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_events');
    }
}
