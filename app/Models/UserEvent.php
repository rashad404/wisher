<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'recurrence',
        'status',
        'user_id',
        'contact_id',
        'group_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function statusName() {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
