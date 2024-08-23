<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Accessor to get the full URL of the photo
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    public function addLikes(array $likes)
    {
        $currentLikes = $this->getAttribute('likes') ?? [];
        $updatedLikes = array_merge($currentLikes, $likes);
        $this->setAttribute('likes', $updatedLikes);
        $this->save();
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'contact_group');
    }

    public function userEvents()
    {
        return $this->hasMany(UserEvent::class);
    }


    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'contact_interests')
                    ->withPivot('type')
                    ->withTimestamps();
    }
}