<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Ecommerces extends Model
{
    public $table='Order_Ecommerces';
    public function order_product_Ecommerce()
    {
        return $this->belongsTo(Order_Ecommerce_product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
