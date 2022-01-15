<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPart extends Model
{
    //
    protected $fillable = [
        'order_id',
        'subtotal',
        'product_price',
        'quantity',
        'name',
    ];
}
