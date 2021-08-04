<?php

namespace App\Http\Controllers;

use App\Sector;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommerceController extends Controller
{
    public function showCommerce(){
        

        $products= Product::all();
        /* dd($products); */
        return view('welcome', compact('products'));
    }

    public function index(Request $request)
    {
        
        $products= Product::all();
        $priceMin=$request->prezzo_min;
        $priceMax=$request->prezzo_max;


    //VALIDAZIONE DATI NEL CASO IN CUI UN CAMPO VENISSE LASCIATO VUOTO
        if ($request->prezzo_min === null) {
            $priceMin=0;
            
        }else{
            $priceMin=$request->prezzo_min;
        }
        
        if ($request->prezzo_max === null) {
            $priceMax=10000;
            
        }else{
            $priceMax=$request->prezzo_max;
        }

        
    //QUERY DI SELECT SU DB CON I DATI INSERITI IN INPUT  

        $filtered=Product::where([
            ['prezzo_al_pezzo', '>=', $priceMin],
            ['prezzo_al_pezzo', '<=', $priceMax],
            ])->orderBy('prezzo_al_pezzo')->get();

            /* dd($priceMin, $priceMax); */

        if ($priceMin || $priceMax) {
            /* dd($filtered); */
            return view('welcomefiltered', compact('filtered'));
        }
        
        
        /* dd($filtered); */

        /* $price =$query->paginate(5); */
        return view('welcome', compact('priceMin','priceMax', 'products'));
        
    }
}
