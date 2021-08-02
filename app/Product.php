<?php

namespace App;

use App\filter\ProductFilter;
use App\Observers\ProductObserver;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{

    use Sortable;

    public function sector(){
        return $this->hasOne('App\Sector');
    }
    public function order_product()
    {
        return $this->belongsTo('App\Order_Product');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }


    public $sortable = [
        "id",
        "codice_prodotto",
        "codice_stock",
        "name",
        "lotto",
        "created_at",
        "updated_at",
        "data_di_scadenza",
        "photo"

    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new ProductFilter($request))->filter($builder);
    }
}
