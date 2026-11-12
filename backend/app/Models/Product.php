<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model {
 protected $guarded=['id'];
 protected $hidden=['source_hash'];
 protected $appends=['stale'];
 protected function casts():array{return ['occasions'=>'array','recipients'=>'array','active'=>'boolean','checked_at'=>'datetime','discovered_at'=>'datetime','price_minor'=>'integer'];}
 public function getStaleAttribute():bool{return !$this->checked_at || $this->checked_at->lt(now()->subDays(2));}
}
