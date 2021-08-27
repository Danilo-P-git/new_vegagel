<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_Product;
use App\Product;
use App\Sector;
use App\User;
use Illuminate\Http\Request;

class OrderCommerce extends Controller
{
    public function orderCreate(Request $request){
        

        $orders = Order::with('user')->where('completato', 0)->orderBy('created_at')->get();
        /* dd($request->all()); */
        $products=Product::all();
        $id=$request->id;
        /* $id=array(
            ["id"=>$request->id]
        ); */
        /* dd($id); */
        $products = Product::find($id);

        return view('worker.orders',compact('id', 'orders'));
    }

    public function show($id)
    {
        
        $orders = Order::find($id);
        $pivot = Order_product::where('order_id', $id)->get();
        // dd($pivot);
        $arrayProduct = array();
        foreach ($pivot as $key) {
            array_push($arrayProduct, $key->product_id);
            
        }
        
        
        $products = Product::with('sector')->whereIn('id', $arrayProduct)->get();
        
        return view('worker.orderShow', compact('pivot','orders','products'));
    }



}
