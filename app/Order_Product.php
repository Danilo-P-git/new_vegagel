<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\Order_ProductObserver;

class Order_Product extends Model
{
    public $table = "order_product";

    
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function Product()
    {
        return $this->hasMany(Product::class);
    }
}
