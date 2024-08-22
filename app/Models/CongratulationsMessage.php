<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CongratulationsMessage extends Model
{
    protected $fillable = [
        'important_date_category_id', // Foreign key
        'language',
        'message',
    ];

    public function importantDateCategory()
    {
        return $this->belongsTo(ImportantDateCategory::class);
    }

    public function importantDate()
    {
        return $this->belongsTo(ImportantDate::class);
    }

}
