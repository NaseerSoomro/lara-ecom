<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'color_code',
        'status',
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'color_products', 'product_id' ,'color_id')->withPivot('id', 'color_quantity');
    }
}
