<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class InterestCategory extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'position', 'status'];

    public $translatable = ['name'];

    public function interests()
    {
        return $this->hasMany(Interest::class);
    }

    public function trans($attribute)
    {
        return $this->getTranslation($attribute, app()->getLocale());
    }
}
