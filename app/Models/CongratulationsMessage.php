<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongratulationsMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'important_date_id',
        'important_date_category_id',
        'language',
        'message',
    ];

    public function importantDate()
    {
        return $this->belongsTo(ImportantDate::class, 'important_date_id');
    }

    public function importantDateCategory()
    {
        return $this->belongsTo(ImportantDateCategory::class, 'important_date_category_id');
    }
}

