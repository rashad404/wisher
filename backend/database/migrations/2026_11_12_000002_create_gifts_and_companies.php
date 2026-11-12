<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up():void {
  Schema::create('products',function(Blueprint $t){$t->id();$t->string('title',200);$t->string('store',80);$t->string('source_url',1000);$t->string('source_hash',64)->unique();$t->string('image_url',1000)->nullable();$t->string('description',600)->default('');$t->string('category',30)->index();$t->json('occasions');$t->json('recipients');$t->unsignedInteger('price_minor')->nullable()->index();$t->string('currency',3)->default('AZN');$t->string('availability',20)->default('unknown');$t->boolean('active')->default(true);$t->timestamp('checked_at')->nullable();$t->timestamp('discovered_at')->nullable();$t->timestamps();$t->index(['active','category','price_minor']);});
  Schema::create('wishlist_items',function(Blueprint $t){$t->id();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->foreignId('product_id')->constrained()->cascadeOnDelete();$t->timestamps();$t->unique(['user_id','product_id']);});
  Schema::create('companies',function(Blueprint $t){$t->id();$t->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();$t->string('name',120);$t->string('signature',200)->default('');$t->string('color',7)->default('#562841');$t->timestamps();});
  Schema::create('company_people',function(Blueprint $t){$t->id();$t->foreignId('company_id')->constrained()->cascadeOnDelete();$t->string('name',100);$t->string('email')->nullable();$t->string('kind',20)->default('employee');$t->date('birthday')->nullable();$t->string('department',80)->default('');$t->timestamps();$t->index(['company_id','name']);});
  Schema::create('campaigns',function(Blueprint $t){$t->id();$t->foreignId('company_id')->constrained()->cascadeOnDelete();$t->string('title',120);$t->date('date');$t->string('occasion',40);$t->unsignedInteger('budget_minor')->default(0);$t->text('message')->nullable();$t->string('status',20)->default('draft');$t->foreignId('product_id')->nullable()->constrained()->nullOnDelete();$t->timestamps();$t->index(['company_id','date']);});
  Schema::create('campaign_person',function(Blueprint $t){$t->foreignId('campaign_id')->constrained()->cascadeOnDelete();$t->foreignId('company_person_id')->constrained()->cascadeOnDelete();$t->primary(['campaign_id','company_person_id']);});
  Schema::create('reminders',function(Blueprint $t){$t->id();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->foreignId('occasion_id')->constrained()->cascadeOnDelete();$t->date('occurrence_date');$t->timestamp('read_at')->nullable();$t->timestamps();$t->unique(['occasion_id','occurrence_date']);$t->index(['user_id','read_at']);});
 }
 public function down():void {foreach(['reminders','campaign_person','campaigns','company_people','companies','wishlist_items','products'] as $table)Schema::dropIfExists($table);}
};
