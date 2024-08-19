<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class ImportantDate extends Model
{
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
        return $this->belongsTo(ImportantDateCategory::class);
    }
}
