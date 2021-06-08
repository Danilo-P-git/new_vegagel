<?php

namespace App\Observers;
use App\Product;
use App\Sector;
use App\Order;
use App\User;
use App\Order_Product;
class SectorObserver
{
    public function retrieved(Sector $sector)
    {
        $quantitaBloccata =  $sector->quantita_bloccata;
        // dd($sector->product->id);
        $orders = Order_Product::where('product_id', '=', $sector->product->id)->get();
        // dd(count($orders)>0);
        if (count($orders)>0) {
            $quantitaTotale = 0;
            foreach ($orders as $order) {
                $quantitaTotale += $order->quantita;
                
            }
            // dd($quantitaTotale);
            $sector->quantita_bloccata = $quantitaTotale;
            $sector->push();
        }
    }
}
