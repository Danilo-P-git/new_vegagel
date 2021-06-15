<?php

namespace App\Http\Controllers;
use App\Product;
use App\Sector;
use App\Log;
use App\Order;
use App\Order_Product;

use DB;
use Illuminate\Support\Facades\Auth;
use Sortable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }

    public function displayProducts()
    {
        $products = DB::table("sectors")
        ->join("products", function($join){
            $join->on("product_id", "=", "products.id");
        })
        ->select(DB::raw('sum(quantita_rimanente) AS quantita' ),'products.codice_prodotto', 'products.name', 'products.codice_stock', 'products.data_di_scadenza', DB::raw('sum(quantita_bloccata) AS bloccata'))
        ->groupBy("products.codice_prodotto")
        ->orderBy('products.data_di_scadenza', 'desc')
        ->get();

        $sector = Sector::all();
        return view('admin.ordersCreate', compact('products', 'sector') );
   }


   public function addOrder(Request $request, $id)
   {
    $products = Product::with('sector')->find($id);
    // dd($request->quantita_bloccata);
   $products->sector->quantita_bloccata = $products->sector->quantita_bloccata + $request->quantita_bloccata;
    $products->push();
    // dd($products);
   return redirect()->back() ;
   }

   public function quantitaBloccata(Request $request, $id)
   {
    //    dd($id);
       $products = Product::with('sector')->find($id);
        // dd($request->quantita_bloccata);
       $products->sector->quantita_bloccata = $products->sector->quantita_bloccata + $request->quantita_bloccata;
        $cart = $request->session()->get('cart');
        $cart[] = array(
            "id" => $products->id,
            "nome"=> $products->name,
            "lotto" => $products->codice_stock,
            "codice_prodotto" => $products->codice_prodotto,
            "prezzoKg" => $products->prezzo_al_kg,
            "prezzoPezzo" => $products->prezzo_al_pezzo,
            "quantita" => $request->quantita_bloccata,
            
        );
        
        $request->session()->put('cart', $cart);
        $request->session()->flash('message', 'Inserimento riuscito');
        
        $products->push();
        
        // dd($products);
       return redirect()->back() ;
   }

   public function orderSend(Request $request)
   {
        $cart = session()->get('cart');
        
        // dd($cart); 

        $order = New Order;
        $order->user_id = Auth::id();
        $order->data_di_consegna = $request->data_di_consegna;
        $order->save();
        $id = $order->id;
        // dd($cart)
        foreach ($cart as $key) {
            $pivot = New Order_Product;
            $pivot->order_id = $id;
            $pivot->product_id = $key['id'];
            $pivot->quantita = $key['quantita'];
            $pivot->save();
        }

        session()->forget('cart');
        session()->flash('message', 'Ordine inviato');

        return redirect()->back();

   }
}
