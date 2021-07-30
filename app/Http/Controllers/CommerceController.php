<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sector;
use Illuminate\Http\Request;

class CommerceController extends Controller
{
    public function showCommerce(){

        $products= Product::all();
        
        return view('ecommerce.homecommerce', compact('products'));
    }
}
