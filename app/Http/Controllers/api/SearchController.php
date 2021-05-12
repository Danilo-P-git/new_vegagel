<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Sortable;

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
}
