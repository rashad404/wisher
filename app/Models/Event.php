<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'date', 'is_recurring', 'is_annual', 'is_monthly', 'category_id', 'status', 'position'
    ];

    protected $casts = [
        'date' => 'date',
        'is_recurring' => 'boolean',
        'is_annual' => 'boolean',
        'is_monthly' => 'boolean',
        'position' => 'integer'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }
}
