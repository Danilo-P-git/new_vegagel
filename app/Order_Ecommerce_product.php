<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Ecommerce_product extends Model
{
    public $table = "order_ecommerce_product";

    
    public function orderEcommerce()
    {
        return $this->hasMany(Order_Ecommerces::class);
    }
    public function Product()
    {
        return $this->hasMany(Product::class);
    }
}
