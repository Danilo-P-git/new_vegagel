<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Product;
use App\Sector;
use App\Log;
use Sortable;
use DB;
class ProductController extends Controller
{

    public function home() {
        return view('worker.home');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('sector')->sortable()->get();
        
        return view('worker.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('worker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function search (Request $request) {
        
        $data = $request->all();
        if ($data['q'] == null) {
            $data['q'] = "";
        }
        $searches = DB::table("sectors")
        ->join("products", function($join){
            $join->on("product_id", "=", "products.id");
        })
        ->select(DB::raw('sum(quantita_rimanente) AS quantita' ),'products.codice_prodotto', 'products.name', 'sectors.quantita_bloccata', 'products.esaurito','products.peso')
        ->where([
            ["codice_prodotto", 'LIKE', '%' . $data['q'] . '%' ],
            ['products.esaurito', '=',  0],
            ])
        ->orWhere ([
                 ['products.codice_stock', 'LIKE', '%' . $data['q'] . '%'],
                 ['products.esaurito', '=', 0], 
        ])
        ->orWhere([
            ['name', 'LIKE', '%'. $data['q'] . '%'],
            ['products.esaurito', '=', 0],
            ])
        ->groupBy("products.codice_prodotto")
        ->get();


        $products = Product::where([
            [ 'codice_stock', 'LIKE', '%' . $data['q'] . '%' ],
            ['esaurito', 0],
             ])
        ->orWhere([
             ['codice_prodotto', 'LIKE', '%' . $data['q'] . '%' ],
             ['esaurito', 0],
             ])
        ->orWhere([
            ['name', 'LIKE', '%'. $data['q'] . '%'],
            ['esaurito', 0],
            ])
        ->with('sector')->sortable('data_di_scadenza', 'asc')->get();


            return view('worker.search', compact('products','searches') );
    }
    // function shipment ($id)
    // {
    //     $product = Product::findOrFail($id);
    //     return view('worker.shipment', compact('product'));
    // }
    function test(Request $request, $id)
    {
        $product = Product::with('sector')->where('esaurito', 0)->find($id);
        $product->sector->quantita_rimanente = $request->quantita_rimanente;
        $product->sector->quantita_di_cartoni = $request->quantita_di_cartoni;
        
        $product->push();

        $quantita = $product->sector->quantita_rimanente;

        
        if ($quantita <= 0) {

            $utente = Auth::user();
            $newLog = new Log;
            $newLog->nome = $utente->name;
            $newLog->azione = "Uscita merci";
            $newLog->codice_movimento = "cancellazione";
            $newLog->save();

            // $product->delete();
        } else {
            $utente = Auth::user();
            $newLog = new Log;
            $newLog->nome = $utente->name;
            $newLog->azione = "Uscita Merci";
            $newLog->codice_movimento = $product->codice_stock;
            $newLog->save();

        }
        return redirect()->route('worker.home', $product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'codice_prodotto' => "required|max:191",
            'codice_stock' => "required|max:191",
            'data_di_scadenza' => "required|date",
            'lotto'=> "required|max:25",
            'name'=> "required|max:191",
            'description'=> "nullable",
            'prezzo_al_pezzo'=> "required|min:0",
            'prezzo_al_kg'=>"required|min:0",
            'settore'=>"required|max:70",
            'scaffale'=>"required|max:70",
            'quantita_rimanente'=> 'required|integer',
            'quantita_di_cartoni' => 'required|integer',
            'quantita_a_cartone'=> 'required|integer',
            'peso'=> 'required',
             
                ],
    [
        'codice_prodotto.required'=> 'Inserisci il codice prodotto',
        'codice_prodotto.max'=> 'Codice prodotto troppo lungo',
        'codice_stock.required'=> 'Inserisci il Codice Stock',
        'codice_stock.max'=> 'Codice Stock troppo lungo',
        'data_di_scadenza.required'=> 'Inserisci la data di scadenza',
        'data_di_scadenza.date'=> 'Devi inserire una data valida',
        'name.required'=> 'Inserisci il nome del prodotto',
        'name.max' => 'Nome troppo lungo inserisci le informazioni nella descrizione',
        'prezzo_al_pezzo.required'=> 'inserisci il prezzo',
        'prezzo_al_pezzo.min'=> 'inserisci un numero maggiore di zero',
        'prezzo_al_kg.required'=>'inserisci il prezzo al kg',
        'prezzo_al_kg.min'=>'inserisci un numero maggiore di zero',
        'settore.required'=> 'inserisci il settore',
        'settore.max'=> 'nome settore troppo grande',
        'scaffale.required'=> 'inserisci lo scaffale',
        'scaffale.max'=> 'inserimento troppo grande accorcia il nome',
        'quantita_rimanente.required'=> 'Inserisci la quantità',
        'quantita_rimanente.integer'=> 'Devi inserire un numero',
        'quantita_di_cartoni.integer'=> 'Devi inserire un numero'
           
    
    ]);

        $newProduct = new Product;
        $newProduct->codice_prodotto = $request->codice_prodotto;
        $newProduct->codice_stock = $request->codice_stock;
        $newProduct->data_di_scadenza = $request->data_di_scadenza;
        $newProduct->name = $request->name;
        $newProduct->lotto = $request->lotto;
        $newProduct->description = $request->description;
        $newProduct->prezzo_al_pezzo = $request->prezzo_al_pezzo;
        $newProduct->prezzo_al_kg = $request->prezzo_al_kg;
        $newProduct->peso = $request->peso;

        

        $newProduct->save();
        $newSector = new Sector;
        $newSector->product_id = $newProduct->id;
        $newSector->codice_stock = $request->codice_stock;
        $newSector->settore = $request->settore;
        $newSector->scaffale = $request->scaffale;
        $newSector->quantita_rimanente = $request->quantita_rimanente;
        $newSector->quantita_di_cartoni = $request->quantita_di_cartoni;
        $newSector->quantita_a_cartone = $request->quantita_a_cartone;

        $newSector->save();

        $utente = Auth::user();
        $newLog = new Log;
        $newLog->nome = $utente->name;
        $newLog->cognome = $utente->lastname;
        $newLog->azione = "carico merci";
        $newLog->codice_movimento = $request->codice_stock;
        $newLog->save();

        return redirect()->route('worker.home', $newProduct); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Product::where('id', $id)->exists()) {
            $product = Product::where('id', $id)->first();
            //query per la prendersi soltanto il necessario
            $sector = Sector::where('product_id', $id)->select('settore', 'scaffale', 'quantita_rimanente')->first();
            return view('worker.show', compact('product', 'sector'));
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = Product::findOrFail($id);
        return view('worker.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                $request->validate([
            'codice_prodotto' => "required|max:191",
            'codice_stock' => "required|max:191",
            'data_di_scadenza' => "required|date",
            'lotto'=> "required|max:25",
            'name'=> "required|max:191",
            'description'=> "nullable",
            'prezzo_al_pezzo'=> "required|min:0",
            'prezzo_al_kg'=>"required|min:0",
            'settore'=>"required|max:70",
            'scaffale'=>"required|max:70",
            'quantita_rimanente'=> 'required|integer',
            'quantita_bloccata' =>'required|integer',
            'quantita_di_cartoni' => 'required|integer',
            'peso'=> 'required',
             
                ],
    [
        'codice_prodotto.required'=> 'Inserisci il codice prodotto',
        'codice_prodotto.max'=> 'Codice prodotto troppo lungo',
        'codice_stock.required'=> 'Inserisci il Codice Stock',
        'codice_stock.max'=> 'Codice Stock troppo lungo',
        'data_di_scadenza.required'=> 'Inserisci la data di scadenza',
        'data_di_scadenza.date'=> 'Devi inserire una data valida',
        'name.required'=> 'Inserisci il nome del prodotto',
        'name.max' => 'Nome troppo lungo inserisci le informazioni nella descrizione',
        'prezzo_al_pezzo.required'=> 'inserisci il prezzo',
        'prezzo_al_pezzo.integer'=> 'inserisci un numero maggiore di zero',
        'prezzo_al_pezzo.min'=> 'inserisci un numero maggiore di zero',
        'prezzo_al_kg.required'=>'inserisci il prezzo al kg',
        'prezzo_al_kg.min'=>'inserisci un numero maggiore di zero',
        'settore.required'=> 'inserisci il settore',
        'settore.max'=> 'nome settore troppo grande',
        'scaffale.required'=> 'inserisci lo scaffale',
        'scaffale.max'=> 'inserimento troppo grande accorcia il nome',
        'quantita_rimanente.required'=> 'Inserisci la quantità',
        'quantita_rimanente.integer'=> 'Devi inserire un numero',
        'quantita_di_cartoni.integer'=> 'Devi inserire un numero'
           
    
    ]);
        $product = Product::with('sector')->find($id);
        $product->codice_prodotto = $request->codice_prodotto;
        $product->codice_stock = $request->codice_stock;
        $product->data_di_scadenza = $request->data_di_scadenza;
        $product->name = $request->name;
        $product->lotto = $request->lotto;

        $product->description = $request->description;
        $product->prezzo_al_pezzo = $request->prezzo_al_pezzo;
        $product->prezzo_al_kg = $request->prezzo_al_kg;
        $product->peso = $request->peso;

        $product->sector->settore = $request->settore;
        $product->sector->scaffale = $request->scaffale;
        $product->sector->quantita_rimanente = $request->quantita_rimanente;
        $product->sector->quantita_di_cartoni = $request->quantita_di_cartoni;


        $product->push();

        $quantita = $product->sector->quantita_rimanente;


        if ($quantita <= 0) {

            $utente = Auth::user();
            $newLog = new Log;
            $newLog->nome = $utente->name;
            $newLog->azione = "Uscita merci";
            $newLog->codice_movimento = $request->codice_stock;
            $newLog->save();

            // $product->delete();
        } else {
            $utente = Auth::user();
            $newLog = new Log;
            $newLog->nome = $utente->name;
            $newLog->azione = "Spostamento merci";
            $newLog->codice_movimento = $request->codice_stock;
            $newLog->save();

        }
    
        return redirect()->route('worker.spostamento', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
