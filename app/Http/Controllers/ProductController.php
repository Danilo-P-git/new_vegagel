<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Sector;
use Sortable;
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
    public function store(Request $request)
    {
        $newProduct = new Product;
        $newProduct->codice_prodotto = $request->codice_prodotto;
        $newProduct->codice_stock = $request->codice_stock;
        $newProduct->data_di_scadenza = $request->data_di_scadenza;
        $newProduct->name = $request->name;
        $newProduct->description = $request->description;
        $newProduct->costo = $request->costo;
        $newProduct->save();
        $newSector = new Sector;
        $newSector->product_id = $newProduct->id;
        $newSector->codice_stock = $request->codice_stock;
        $newSector->settore = $request->settore;
        $newSector->scaffale = $request->scaffale;
        $newSector->quantita_rimanente = $request->quantita_rimanente;
        $newSector->save();

        return redirect()->route('worker.index', $newProduct); 
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
        $product = Product::with('sector')->find($id);
        $product->codice_prodotto = $product->codice_prodotto;
        $product->codice_stock = $product->codice_stock;
        $product->data_di_scadenza = $product->data_di_scadenza;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->costo = $request->costo;
        $product->sector->settore = $request->settore;
        $product->sector->scaffale = $request->scaffale;
        $product->sector->quantita_rimanente = $request->quantita_rimanente;
        $product->push();

        $quantita = $product->sector->quantita_rimanente;


        if ($quantita <= 0) {

            $product->delete();
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
