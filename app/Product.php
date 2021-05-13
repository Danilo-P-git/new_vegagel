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

    public function sale() {
        return $this->HasMany(Sale::class);
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
