<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Sector;
use App\Log;
use App\Order_Product;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // mostra tutti gli ordini in pending 
    public function index()
    {
        $orders = Order::with('user')->where('completato', 0)->orderBy('created_at')->get();
        /* $orders=array(); */


        //TEST NUOVA VISTA
        /* foreach ($orders as $order) {
            $orders=$order;
            for ($i=0; $order <=0 ; $i++) { 
                dd($order);
            }
            
            dd($orders[1]->data_di_consegna);
            foreach ($order as $key => $value) {
                
            }
            
        } */


        return view('worker.orders', compact('orders'));
    }

    // mostra l'ordine singolo con all'interno i prodotti
    public function show($id)
    {
        
        $orders = Order::find($id);
        $pivot = Order_product::where('order_id', $id)->get();
        dd($pivot);
        $arrayProduct = array();
        foreach ($pivot as $key) {
            array_push($arrayProduct, $key->product_id);
            
        }
        dd($arrayProduct);
        
        $products = Product::with('sector')->whereIn('id', $arrayProduct)->get();
        
        return view('worker.orderShow', compact('pivot','orders','products'));
    }

    // Conferma scansione del prodotto
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
    // conferma dell'ordine 
    public function done($id)
    {
        $pivot = Order_Product::where('order_id', $id)->get();
        foreach ($pivot as $key => $value) {
            $confermato = $value->completato;

            if ($confermato == 0) {
                $validation = false;
            } else {
                $validation = true;
            }
        }

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

    // Salva pdf con bolla di carica dell'ordine 
    public function savePdf($id)
    {
        $pivot = Order_Product::where('order_id', $id)->get();
        $order = Order::with('user')->find($id);
        $arrayProduct = array();
        foreach ($pivot as $key) {
            array_push($arrayProduct, $key->product_id);
            
        }
        $products = Product::with('sector')->whereIn('id', $arrayProduct)->get();

        $pdf = PDF::loadView('pdf.bolla', compact('pivot', 'order', 'products') )->setOptions(['defaultFont' => 'sans-serif']);
        $pdf->setPaper('A4', 'portrait');
        Storage::put('public/order'.$order->id.'.pdf', $pdf->output());

        return $pdf->download('bolla_di_carico'.$order->id.'.pdf');

    }
}
