<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'brand',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'trending',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Product Belongs to which Brand
    // public function brand()
    // {
    //     return $this->belongsTo(Brand::class);
    // }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    // Color belongs to which product
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_products', 'product_id', 'color_id')->withPivot('id', 'color_quantity');
    }

    // A Product has many colors
    // public function colors()
    // {
    //     return $this->hasMany(Product::class, 'product_id', 'id');
    // }
}
