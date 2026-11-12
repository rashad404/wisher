<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Company extends Model {
 protected $guarded=['id','user_id'];
 public function people(){return $this->hasMany(CompanyPerson::class);}
 public function campaigns(){return $this->hasMany(Campaign::class);}
}
