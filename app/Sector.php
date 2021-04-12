<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $primaryKey = 'products_id';

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
