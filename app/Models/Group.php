<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_group');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userEvents()
    {
        return $this->hasMany(UserEvent::class);
    }
}
