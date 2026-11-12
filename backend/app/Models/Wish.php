<?php
namespace App\Models;
class Wish extends \Illuminate\Database\Eloquent\Model {
 protected $guarded = ['id'];
 protected function casts(): array { return ['brief'=>'array','variants'=>'array','saved'=>'boolean']; }
}
