<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Sector;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $products = Product::with('sector')->get();
       return view('worker.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $newSector->products_id = $newProduct->id;
        $newSector->codice_stock = $request->codice_stock;
        $newSector->settore = $request->settore;
        $newSector->scaffale = $request->scaffale;
        $newSector->quantita_rimanente = $request->quantita_rimanente;
        $newSector->save();

        return view('worker.create');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Product::where('id', $id)->exists()) {

            $product = Product::find($id);
            $product->codice_prodotto = $request->codice_prodotto;
            $product->codice_stock = $request->codice_stock;
            $product->data_di_scadenza = $request->data_di_scadenza;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->costo = $request->costo;
            $product->save();


            // Aggiornato il model e gli ho indicato la nuova chiave primaria che sarebbe la nostra foreign key
            $sector = Sector::find($id);

            $sector->codice_stock = $request->codice_stock;
            $sector->settore = $request->settore;
            $sector->scaffale = $request->scaffale;
            $sector->quantita_rimanente = $request->quantita_rimanente;
            $sector->save();

            return response()->json([
                "message" => "update successfull"
            ], 200);
        } else {
            return response()->json([
                "message" => 'product not found'
            ], 404);
        }
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
