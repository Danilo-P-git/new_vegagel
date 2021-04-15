<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{

    use Sortable;

    public function sector(){
        return $this->hasOne('App\Sector');
    }
    public function sale(){
        return $this->hasOne('App\Sale');
    }

    public $sortable = [
        "id",
        "codice_prodotto",
        "name",
        "created_at",
        "updated_at",
        "data_di_scadenza"

    ];
}
