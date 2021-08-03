<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Log;
use Illuminate\Support\Facades\Log as FacadesLog;
use Sortable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome()
    {
        $log = Log::orderBy('created_at', 'DESC')->sortable()->paginate(10);
        /* dd($log); */
        return view('admin.adminhome', compact('log'));
        
    }
    public function workerHome()
    {
        return view('worker.home');
    }

    public function logUser(Request $request)
    {
        $log= Log::all();
        $logUser=$request->logUser;
        //QUERY DI SELECT SU DB CON I DATI INSERITI IN INPUT  
        $log= Log::where([
            ['nome','=', $logUser],
            ])->orderBy('nome')->get();
            /* dd($log); */
            
            
            
            
            
            return view('admin.selected', compact('log'));
        
    }

}
