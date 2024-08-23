<?php

namespace App\Models;

use App\Traits\HasTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Feature extends Model
{
    use HasFactory, HasTranslations, HasTranslatable;

    protected $fillable = ['title', 'text'];

    public $translatable = ['title', 'text'];
}
