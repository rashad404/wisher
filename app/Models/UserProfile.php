<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'dob', 'gender', 'address', 'city', 'state', 'zip', 'country', 'phone_number', 'profile_photo'];


    /**
     * The user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
