<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishPhotoTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'image_path',
        'editable_areas'
    ];

    protected $casts = [
        'editable_areas' => 'array',
    ];

    /**
     * Get the user wish photos based on this template.
     */
    public function userWishPhotos()
    {
        return $this->hasMany(UserWishPhoto::class);
    }
}