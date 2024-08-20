<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasTranslations;

    protected $fillable = ['name', 'role', 'message', 'image', 'is_active'];

    public $translatable = ['message'];  // Specify translatable fields
}
