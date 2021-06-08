<?php

namespace App\Http\Controllers;
use App\Product;
use App\Sector;
use App\Log;
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
        return view('admin.orders');
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
   public function quantitaBloccata(Request $request, $id)
   {
       $products = Product::with('sector')->find($id);
        // dd($request->quantita_bloccata);
       $products->sector->quantita_bloccata = $products->sector->quantita_bloccata + $request->quantita_bloccata;
        $products->push();
        // dd($products);
       return redirect()->back() ;
   }
}
