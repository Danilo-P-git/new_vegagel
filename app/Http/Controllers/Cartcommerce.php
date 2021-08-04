<?php

namespace App\Http\Controllers;
use App\Product;
use App\Sector;
use App\Order;
use App\Order_Product;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class Cartcommerce extends Controller
{
    public function quantitaBloccatacommerce(Request $request, $id)
    {
        dd($request->all());
        $products = Product::with('sector')->where('id', '=', $request->id)->get();
        return redirect()->back();
    }
    
}
