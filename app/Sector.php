<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\SectorObserver;

class Sector extends Model
{

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
