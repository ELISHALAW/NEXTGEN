<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // These allow the checkout loop to save each item
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'size',
        'color',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}