<?php
namespace App\Models;

use App\Traits\HasTranslatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasTranslations, HasTranslatable;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = ['title', 'content'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'author',
        'published_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];
}
