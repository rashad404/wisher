<?php

namespace App\Models;

use App\Traits\HasTranslatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Interest extends Model
{
    use HasTranslations, HasTranslatable;

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
}
