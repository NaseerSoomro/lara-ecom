<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'color_id',
        'color_quantity',
    ];

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
    // public function colorProducts()
    // {
    //     return $this->belongsToMany(Product::class, 'product_id', 'id');
    // }
}
