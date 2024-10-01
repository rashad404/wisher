<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'payment_method',
        'email_address',
        'address',
        'city',
        'region',
        'postal_code',
        'subtotal',
        'shipping',
        'tax',
        'total',
        'product_id',
        'color_id',
        'size_id',
        'quantity',
        'status',
        'contact_ids',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function getContactIdsAttribute($value)
    {
        return json_decode($value, true); // Decode JSON to array
    }

    public function setContactIdsAttribute($value)
    {
        $this->attributes['contact_ids'] = json_encode($value); // Encode array to JSON
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assuming 'user_id' is the sender
    }
}
