<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Sector;
use App\Log;
use App\Order_Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->where('completato', 0)->get();
        return view('worker.orders', compact('orders'));
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
    public function confirm(Request $request, $id) 
    {
        $pivot = Order_Product::find($id);

        $productId = $pivot->product_id;
        $orderId = $pivot->order_id;
        
        $product = Product::with('sector')->where('esaurito', '=', 0)->find($productId);
        // dd($product->sector);
        $product->sector->quantita_rimanente -= $request->quantita;
        $product->sector->quantita_bloccata -= $request->quantita;

        $quantita = $product->sector->quantita_rimanente;
        if ($quantita <= 0) {

            $utente = Auth::user();
            $newLog = new Log;
            $newLog->nome = $utente->name;
            $newLog->azione = "Completamento ordine";
            $newLog->codice_movimento = "cancellazione";
            $newLog->save();


            // $product->delete();
        } else {
            $utente = Auth::user();
            $newLog = new Log;
            $newLog->nome = $utente->name;
            $newLog->azione = "Completamento ordine";
            $newLog->codice_movimento = $product->codice_stock;
            $newLog->save();

        }
        
        
        $product->push();

        $pivot->completato = 1;
        $pivot->push();
        return redirect()->back();
        
    }
    public function done($id)
    {
        $order = Order::find($id);
        $order->completato = 1;
        $order->push();
        $utente = Auth::user();
        $newLog = new Log;
        $newLog->nome = $utente->name;
        $newLog->azione = "Conferma ordine ";
        $newLog->codice_movimento = "Ordine n°".$id;
        $newLog->save();
        return redirect()->back();

    }
}