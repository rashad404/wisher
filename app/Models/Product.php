<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'main_image', 
        'extra_images', 
        'condition', 
        'price', 
        'discounted_price', 
        'sku', 
        'category_id', 
        'features', 
        'brand_id', 
        'product_model_id'
    ];

    // Relationship with Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relationship with ProductVariant
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relationship with ProductModel
    public function productModel()
    {
        return $this->belongsTo(ProductModel::class);
    }

    // Accessor to get average rating
    public function getReviewsAvgRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    // Accessor to get number of reviews
    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }



    public function reviewCount()
    {
        return $this->reviews()->count();
    }
}
