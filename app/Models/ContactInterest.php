<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ContactInterest extends Pivot
{
    protected $table = 'contact_interests';

    protected $fillable = ['contact_id', 'interest_id', 'type'];
}
