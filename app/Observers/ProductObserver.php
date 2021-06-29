<?php

namespace App\Observers;
use App\Product;
use App\Sector;
use App\Order;
use App\User;
use App\Order_Product;

class ProductObserver
{  
    //  ogni volta che il model PRODUCT viene richiamato in qualche query l'observer controlla se la quantità è superiore a zero se non lo è imposta esaurito 1 che va ad eliminare da molte query i prodotti che sono finiti pur mantenendoli nel DB per scopi di logging e di facilità di scansione e di immizzione dati
    // guarda   SearchController@SearchDuplicati 
    public function retrieved(Product $product)
    { 
        if ($product->sector->quantita_rimanente <= 0) {
            $product->esaurito = 1;
            $product->push();
        }
    }

}
