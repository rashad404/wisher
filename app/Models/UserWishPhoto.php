<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWishPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wish_photo_template_id',
        'customization_data',
        'final_image_path',
        'is_public',
        'likes',
        'shares'
    ];

    protected $casts = [
        'customization_data' => 'array',
        'is_public' => 'boolean',
    ];

    /**
     * Get the user that owns the wish photo.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the template that the wish photo is based on.
     */
    public function wishPhotoTemplate()
    {
        return $this->belongsTo(WishPhotoTemplate::class);
    }
}