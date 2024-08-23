<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Interest extends Model
{
    use HasTranslations;

    protected $fillable = ['interest_category_id', 'name', 'position', 'status'];

    public $translatable = ['name'];

    public function category()
    {
        return $this->belongsTo(InterestCategory::class, 'interest_category_id');
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_interests')->withPivot('type')->withTimestamps();
    }

    // Custom method to get translation based on current locale
    public function trans($attribute)
    {
        return $this->getTranslation($attribute, app()->getLocale());
    }
}
