<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'total_price',
        'delivery_address',
        'invoice_address',
        'delivery_date'
    ];

    public function orderParts(){
        return $this->hasMany(OrderPart::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

}
