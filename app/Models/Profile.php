<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles'; // Set the table name

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'dob',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'phone_number',
    ];

}
