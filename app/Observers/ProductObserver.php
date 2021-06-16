<?php

namespace App\Observers;
use App\Product;
use App\Sector;
use App\Order;
use App\User;
use App\Order_Product;

class ProductObserver
{
    public function retrieved(Product $product)
    {
        if ($product->sector->quantita_rimanente <= 0) {
            $product->esaurito = 1;
            $product->push();
        }
    }

}
