<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // mostra tutte le categorie
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    // creazione e storing della categoria
    public function store(Request $request)
    {

        if ($request->reperibile == 'on') {
            $reperibile = 1;
        } else {
            $reperibile = 0;
        }
        $category = new Category;

        $category->tipo = $request->tipo;
        $category->reperibile = $reperibile;
        $category->save();

        return redirect()->back() ;

    }

}
