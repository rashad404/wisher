<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportantDateCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position'];

    public function importantDates()
    {
        return $this->hasMany(ImportantDate::class, 'category_id');
    }

    public function congratulationsMessages()
    {
        return $this->hasMany(CongratulationsMessage::class, 'important_date_category_id');
    }
}
