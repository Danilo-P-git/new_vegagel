<?php

namespace App\Http\Controllers;
use App\Product;
use App\Sector;
use App\Log;
use App\Order;
use App\Order_Product;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Sortable;
use Carbon\Carbon;
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
        $orders = Order::orderBy('created_at', 'DESC')->get();
        return view('admin.orders', compact('orders'));
    }

    public function displayProducts()
    {
        $today = Carbon::now()->format('Y-m-d');
        // $today = Carbon::createFromFormat('Y-m-d', $date);
        $todayFormat = Carbon::now();
        $traUnMeseFormat = $todayFormat->addMonth();
        $traUnMese = $traUnMeseFormat->format('Y-m-d');
        // dd($traUnMese);
        $products = DB::table("sectors")
        ->join("products", function($join){
            $join->on("product_id", "=", "products.id");
        })
        ->select(DB::raw('sum(quantita_rimanente) AS quantita' ),'products.id','products.codice_prodotto', 'products.name', 'products.codice_stock', 'products.data_di_scadenza', 'products.esaurito','products.peso', DB::raw('sum(quantita_bloccata) AS bloccata'))
        ->where('esaurito', '=', 0)
        ->groupBy("products.codice_prodotto")
        ->orderBy('products.data_di_scadenza', 'desc')
        ->get();

        $sector = Sector::all();
        $observerCall = Product::all();
        $users = User::where('ragione_sociale', '!=', NULL)->get();
        return view('admin.ordersCreate', compact('products', 'sector', 'users','today', 'traUnMese') );
   }


//    public function addOrder(Request $request, $id)
//    {
//     $products = Product::with('sector')->where('esaurito', '=', 0)->find($id);
//     // dd($request->quantita_bloccata);
//    $products->sector->quantita_bloccata = $products->sector->quantita_bloccata + $request->quantita_bloccata;
//     $products->push();
//     // dd($products);
//    return redirect()->back() ;
//    }

   public function quantitaBloccata(Request $request, $id)
   {
    //    dd($id);
       $products = Product::with('sector')->where('esaurito', '=', 0)->find($id);
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
        $order->user_id = $request->user;
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

   public function deleteCart($id)
   {
    $cart = session()->get('cart');
    $quantita_bloccata = $cart[$id]['quantita'];
    $idProduct = $cart[$id]['id'];
    $products = Product::with('sector')->find($idProduct);
    
    $products->sector->quantita_bloccata = $products->sector->quantita_bloccata - $quantita_bloccata;
    $quantitaTemp = $products->sector->quantita_bloccata;
    if ( $quantitaTemp >=0    ) {
    $products->push();
        
    }

    unset($cart[$id]);
    session()->put('cart', $cart);
    if (count($cart)==0) {
        session()->forget('cart');

    }

    return redirect()->back() ;
          
   }
}
