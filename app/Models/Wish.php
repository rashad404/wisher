<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    use HasFactory;

    protected $fillable = ['lang', 'event_id', 'title', 'text'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
