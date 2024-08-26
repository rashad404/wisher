<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position'];

    public function Events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
