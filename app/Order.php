<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function order_product()
    {
        return $this->belongsTo(Order_Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
