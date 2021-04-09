<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function sector(){
        return $this->hasOne('App\Sector');
    }
    public function sale(){
        return $this->hasOne('App\Sale');
    }
}
