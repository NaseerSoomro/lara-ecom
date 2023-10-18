<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'tracking_no',
        'full_name',
        'phone',
        'email',
        'pin_code',
        'address',
        'status_message',
        'payment_mode',
        'payment_id'
    ];
}
