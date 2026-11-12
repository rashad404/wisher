<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Campaign extends Model {
 protected $guarded=['id','company_id'];
 protected function casts():array{return ['budget_minor'=>'integer'];}
 public function people(){return $this->belongsToMany(CompanyPerson::class,'campaign_person');}
 public function product(){return $this->belongsTo(Product::class);}
}
