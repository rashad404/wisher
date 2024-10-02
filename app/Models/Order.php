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
        'shipping_addresses',
        'notes',
    ];

    protected $casts = [
        'contact_ids' => 'array',
        'shipping_addresses' => 'array',
        'notes' => 'array',
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

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
