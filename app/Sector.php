<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $primaryKey = 'product_id';

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
