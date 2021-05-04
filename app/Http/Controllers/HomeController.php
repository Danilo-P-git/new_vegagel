<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Log;
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
        $log = Log::sortable()->paginate(10);
        return view('admin.adminhome', compact('log'));

    }
    public function workerHome()
    {
        return view('worker.home');
    }

}
