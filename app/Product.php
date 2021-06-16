<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Observers\ProductObserver;

class Product extends Model
{

    use Sortable;

    public function sector(){
        return $this->hasOne('App\Sector');
    }
    public function order_product()
    {
        return $this->belongsTo(Order_Product::class);
    }


    public $sortable = [
        "id",
        "codice_prodotto",
        "codice_stock",
        "name",
        "lotto",
        "created_at",
        "updated_at",
        "data_di_scadenza"

    ];
}
