<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ImportantDateCategory extends Model
{
    protected $fillable = ['name', 'position'];

    public function importantDates(): HasMany
    {
        return $this->hasMany(ImportantDate::class);
    }
}
