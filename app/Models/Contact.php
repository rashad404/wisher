<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Add likes to the contact's likes JSON column.
     *
     * @param array $likes
     * @return void
     */
    public function addLikes(array $likes)
    {
        $currentLikes = $this->getAttribute('likes') ?? [];

        // Merge the new likes with the existing likes
        $updatedLikes = array_merge($currentLikes, $likes);

        // Update the likes JSON column with the updated likes
        $this->setAttribute('likes', $updatedLikes);
        $this->save();
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'contact_group');
    }

}
