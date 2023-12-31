<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'status'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'category_id', 'id');
    // }
}
