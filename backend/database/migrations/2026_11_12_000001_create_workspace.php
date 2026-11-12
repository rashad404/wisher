<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::create('users', function(Blueprint $t) { $t->id(); $t->string('kimlik_id')->nullable()->unique(); $t->string('name'); $t->string('email')->nullable()->unique(); $t->timestamp('email_verified_at')->nullable(); $t->string('password')->nullable(); $t->string('timezone')->default('Asia/Baku'); $t->string('language', 5)->default('az'); $t->boolean('is_demo')->default(false); $t->timestamps(); });
  Schema::create('personal_access_tokens', function(Blueprint $t) { $t->id(); $t->morphs('tokenable'); $t->string('name'); $t->string('token',64)->unique(); $t->text('abilities')->nullable(); $t->timestamp('last_used_at')->nullable(); $t->timestamp('expires_at')->nullable()->index(); $t->timestamps(); });
  Schema::create('contacts', function(Blueprint $t) { $t->id(); $t->foreignId('user_id')->constrained()->cascadeOnDelete(); $t->string('name',100); $t->string('relationship',60); $t->string('group',60)->default(''); $t->string('email')->nullable(); $t->date('birthday')->nullable(); $t->string('notes',500)->nullable(); $t->timestamps(); $t->index(['user_id','name']); $t->index(['user_id','group']); });
  Schema::create('occasions', function(Blueprint $t) { $t->id(); $t->foreignId('user_id')->constrained()->cascadeOnDelete(); $t->foreignId('contact_id')->nullable()->constrained()->nullOnDelete(); $t->string('title',120); $t->string('occasion',40); $t->date('date'); $t->date('next_date')->index(); $t->string('recurrence',10)->default('none'); $t->timestamps(); $t->index(['user_id','next_date']); });
  Schema::create('wishes', function(Blueprint $t) { $t->id(); $t->foreignId('user_id')->constrained()->cascadeOnDelete(); $t->uuid('request_key'); $t->string('input_hash',64); $t->json('brief'); $t->json('variants')->nullable(); $t->text('selected_text')->nullable(); $t->string('status',12)->default('pending'); $t->string('provider',20); $t->boolean('saved')->default(false); $t->timestamps(); $t->unique(['user_id','request_key']); $t->index(['user_id','saved','created_at']); $t->index(['created_at','status']); });
  Schema::create('generation_budgets', function(Blueprint $t) { $t->string('scope')->primary(); $t->unsignedInteger('used')->default(0); });
 }
 public function down(): void { foreach(['generation_budgets','wishes','occasions','contacts','personal_access_tokens','users'] as $table) Schema::dropIfExists($table); }
};
