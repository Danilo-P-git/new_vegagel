<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Sector;
use App\Product;
use Carbon\Carbon;
use App\Order_Ecommerces;
use Illuminate\Http\Request;
use App\Order_Ecommerce_product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminCartEcommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order_Ecommerces::orderBy('created_at', 'DESC')->get();
        return view('ecommerce.orders', compact('orders'));
    }

    // Questa funzione raggruppa tutti i prodotti in base al loro codice prodotto e somma la loro quantita e le loro informazioni 
    public function displayProducts()
    {
        $today = Carbon::now()->format('Y-m-d');
        // $today = Carbon::createFromFormat('Y-m-d', $date);
        $todayFormat = Carbon::now();
        $traUnMeseFormat = $todayFormat->addMonth();
        $traUnMese = $traUnMeseFormat->format('Y-m-d');
        // dd($traUnMese);
        // Vecchia query da fare refactoring
        $products = DB::table("sectors")
        ->join("products", function($join){
            $join->on("product_id", "=", "products.id");
        })
        ->select(DB::raw('sum(quantita_rimanente) AS quantita' ),'products.id','products.codice_prodotto', 'products.name', 'products.codice_stock', 'products.data_di_scadenza','products.peso', DB::raw('sum(quantita_bloccata) AS bloccata'))
        
        ->groupBy("products.codice_prodotto")
        ->orderBy('products.data_di_scadenza', 'desc')
        ->get();
        // Vecchia query da fare refactoring

        $sector = Sector::all();
        $observerCall = Product::all();
        $users = User::where('ragione_sociale', '!=', NULL)->get();

        $orderEcommerce=Order_Ecommerces::all();
        /* dd($orderEcommerce); */
        return view('ecommerce.ordersCreate', compact('products', 'sector', 'users','today', 'traUnMese','orderEcommerce') );
    }

        // TEST 
//    public function addOrder(Request $request, $id)
//    {
//     $products = Product::with('sector')->where('esaurito', '=', 0)->find($id);
//     // dd($request->quantita_bloccata);
//    $products->sector->quantita_bloccata = $products->sector->quantita_bloccata + $request->quantita_bloccata;
//     $products->push();
//     // dd($products);
//    return redirect()->back() ;
//    }
        // TEST 


    // blocco di quantita e creazione "carrello nella sessione"
    public function quantitaBloccata(Request $request, $id)
    {
        
        /* dd($request); */
        
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
            "user"=>$request->user,//test
            "zona"=>$request->zona,
            "data_di_consegna"=>$request->data_di_consegna,
            
        );
        /* dd($cart); */

        //INIZIO SALVATAGGIO DATI DIRETTAMENTE NEL DB
        
        $orderEcommerce = New Order_Ecommerces;
        $orderEcommerce->user_id = Auth::User()->id;
        $orderEcommerce->data_di_consegna = $request->data_di_consegna;
        $orderEcommerce->ecommerce = $request->zona;
        $orderEcommerce->save();
        /* dd($orderEcommerce); */
        $idOrder=$orderEcommerce->id;
        /* dd($cart); */
        foreach ($cart as $key){

            $orderProductEcommerce= New order_Ecommerce_product();
            $orderProductEcommerce->order_ecommerce_id = $idOrder;
            $orderProductEcommerce->product_id=$key['id'];
            $orderProductEcommerce->quantita=$key['quantita'];
            $orderProductEcommerce->save();

        }
        
        

        /* dd($orderProductEcommerce); */

        

        //FINE SALVATAGGIO DATI NEL DB
        
        $request->session()->pull('cart', $cart);
        $request->session()->flash('message', 'Inserimento riuscito');
        
        $products->push();
        
        // dd($products);
       return redirect()->back() ;
    }



    // Creazione e invio ordine ai lavoratori e cancellazione CART 
    public function orderSend(Request $request)
    {
        $cart = session()->get('cart');
        
        /* dd($request, $cart); */

        /* $order = New Order_Ecommerces; */
        $order= DB::table('update Order_Ecommerce set data_di_consegna=?',[$request->data_di_consegna]);
        /* $order->user_id = $request->user; //da togliere
        $order->data_di_consegna = $request->data_di_consegna; //da fare update */
        $order->save();
        $id = $order->id;
        // dd($cart)
        foreach ($cart as $key) {
            $pivot = New Order_Ecommerce_product();
            $pivot->order_ecommerce_id = $id;
            $pivot->product_id = $key['id'];
            $pivot->quantita = $key['quantita'];
            $pivot->save();
        }

        session()->forget('cart');
        session()->flash('message', 'Ordine inviato');

        return redirect()->back();

    }
    // Creazione e invio ordine ai lavoratori e cancellazione CART 

    // Cancellazione elemento singolo dal cart 
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

        return redirect()->back();
          
   }


}
