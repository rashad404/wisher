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
            $table->string('name');
            $table->date('date');
            $table->tinyInteger('recurrence')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('contact_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('group_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_events');
    }
}
