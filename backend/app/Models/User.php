<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable {
 use HasApiTokens;
 protected $guarded = ['id'];
 protected $hidden = ['password'];
 protected function casts(): array { return ['is_demo'=>'boolean','email_verified_at'=>'datetime']; }
 public function contacts() { return $this->hasMany(Contact::class); }
 public function occasions() { return $this->hasMany(Occasion::class); }
 public function wishes() { return $this->hasMany(Wish::class); }
}
