<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Sortable;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SearchController extends Controller
{
    public function aziende() {
        $filter = $_GET['filter'];
        $azienda = User::
        where('is_admin',0)
        ->where('is_worker',0)
        ->whereNotNull('ragione_sociale')
        ->where('ragione_sociale', 'LIKE', '%'.$filter. '%')
        ->orWhereNull('is_admin')
        ->whereNull('is_worker')
        ->whereNotNull('ragione_sociale')
        ->where('ragione_sociale', 'LIKE', '%'.$filter. '%')
        ->get();
        return response()->json($azienda);
    }

    public function utente(){
        $filter = $_GET['filter'];
        $utente = User::
        where('is_admin',0)
        ->where('is_worker',0)
        ->whereNull('ragione_sociale')
        ->where('email', 'LIKE', '%'.$filter. '%')
        ->orWhereNull('is_admin')
        ->whereNull('is_worker')
        ->whereNull('ragione_sociale')
        ->where('email', 'LIKE', '%'.$filter. '%')
        ->get();
        return response()->json($utente);

    }

    public function prodottoSingolo(){
        $cod_prodotto = $_GET['codice_prodotto'];
        $prodotto = Product::with('sector')->where('codice_prodotto', "=", $cod_prodotto)->get();

         return response()->json($prodotto);
    }

    public function scanDuplicate(){
        $cod_prodotto = $_GET['codice_prodotto'];
        try {

            $prodotto = Product::with('sector')->where('codice_prodotto', "=", $cod_prodotto)->firstOrFail();
        }

        catch(ModelNotFoundException $e) {
            $prodotto = "Nessun prodotto con questo codice;";
        }
        return response()->json($prodotto);
    }
}
