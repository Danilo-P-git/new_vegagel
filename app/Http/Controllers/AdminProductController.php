<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use App\Order;
use App\Product;
use App\Sector;
use App\Log;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;
class AdminProductController extends Controller
{
    // Mostra tutti i prodotti separati per data di scadenza sortable
    public function index(){
        $todayFormat = Carbon::now();
        $oneMonthFormat = Carbon::now()->addMonth();
        $today = $todayFormat->format('Y-m-d');
        $oneMonth = $oneMonthFormat->format('Y-m-d');
        
        // In scadenza
        $inScadenza = Product::with('category', 'sector')->where('esaurito', "!=", 1)->whereBetween('data_di_scadenza', [$today, $oneMonth])->sortable()->paginate(10);
        

        // Scaduti
        $scaduti = Product::with('category', 'sector')->where([
            ['data_di_scadenza', "<", $today],
            ['esaurito', "!=", 1],
        ])->sortable()->paginate(10);

        $products = Product::with('category', 'sector')->where([
            ['data_di_scadenza', '>', $oneMonth],
            ['esaurito', "!=", 1],
            
        ])->sortable()->paginate(10);

        return view('admin.products', compact('inScadenza', 'scaduti', 'products'));
    }
    // Mostra tutti i prodotti separati per data di scadenza sortable

    // funzione stampa pdf 
    public function stampaScaduti(){
        $today = Carbon::now()->format('Y-m-d');

        $scaduti = Product::with('category', 'sector')->where([
            ['data_di_scadenza', "<", $today],
            ['esaurito', "!=", 1],
        ])->get();
        $pdf = PDF::loadView('pdf.scaduti', compact('scaduti') )->setOptions(['defaultFont' => 'sans-serif']);
        $pdf->setPaper('A4', 'portrait');
        Storage::put('public/scaduti/tab_scaduti_'.$today.'.pdf', $pdf->output());
        return $pdf->download('tab_scaduti_'.$today.'.pdf');
    }

    public function stampaInScadenza(){
        $todayFormat = Carbon::now();
        $oneMonthFormat = Carbon::now()->addMonth();
        $today = $todayFormat->format('Y-m-d');
        $oneMonth = $oneMonthFormat->format('Y-m-d');

        $inScadenza = Product::with('category', 'sector')->where('esaurito', "!=", 1)->whereBetween('data_di_scadenza', [$today, $oneMonth])->get();

        $pdf = PDF::loadView('pdf.inScadenza', compact('inScadenza') )->setOptions(['defaultFont' => 'sans-serif']);
        $pdf->setPaper('A4', 'portrait');
        Storage::put('public/inScadenza/tab_inScadenza_'.$today.'.pdf', $pdf->output());
        return $pdf->download('tab_inScadenza_'.$today.'.pdf');
    }

    public function stampaProdotti(){
        $todayFormat = Carbon::now();
        $oneMonthFormat = Carbon::now()->addMonth();
        $today = $todayFormat->format('Y-m-d');
        $oneMonth = $oneMonthFormat->format('Y-m-d');

        $products = Product::with('category', 'sector')->where([
            ['data_di_scadenza', '>', $oneMonth],
            ['esaurito', "!=", 1],
            
        ])->get();
        $pdf = PDF::loadView('pdf.prodotti', compact('products') )->setOptions(['defaultFont' => 'sans-serif']);
        $pdf->setPaper('A4', 'portrait');
        Storage::put('public/products/tab_products_'.$today.'.pdf', $pdf->output());
        return $pdf->download('tab_products_'.$today.'.pdf');
    }
}
