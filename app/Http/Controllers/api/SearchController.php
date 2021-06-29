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
    // API RICERCA AZIENDA 
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




    // API RICERCA UTENTE 
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



    // Dal codice del prodotto  al prodotto singolo con lotto e data_scadenza
    public function prodottoSingolo(){
        $cod_prodotto = $_GET['codice_prodotto'];
        $prodotto = Product::with('sector')->where([
            ['codice_prodotto', "=", $cod_prodotto],
            ['esaurito', "=", 0],
            ]
            )->get();

         return response()->json($prodotto);
    }
    // Automatizzazione nello scan se il codice del prodotto è in database mi torna tutte le info utili 
    public function scanDuplicate(){
        $cod_prodotto = $_GET['codice_prodotto'];
        try {

            $prodotto = Product::with('sector')->where('codice_prodotto', "=", $cod_prodotto)->firstOrFail();
        }
        // in caso di errre mi ritorna comunque la variabile prodotto con un risultato per evitare la gestione di errori particolari lato js 
        catch(ModelNotFoundException $e) {
            $prodotto = "Nessun prodotto con questo codice;";
        }
        return response()->json($prodotto);
    }
}
