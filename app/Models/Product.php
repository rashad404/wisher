<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'main_image', 'extra_images', 'condition',
        'price', 'discounted_price', 'sku', 'category_id', 'brand', 'model', 'features'
    ];

    protected $casts = [
        'extra_images' => 'array', // Casting to array
        'features' => 'array',
    ];

    // Relationships
    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productModel()
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reviewCount()
    {
        return $this->reviews()->count();
    }

}
