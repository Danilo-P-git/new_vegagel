<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Sortable;


class UserModController extends Controller
{
    public function showUser() {
        // $users = User::where('users.is_worker AND users.is_admin', '=', '0')->orWhere('users.is_worker  && users.is_admin', '=', 'null')->get();
        
        $users = User::
        where('is_admin',0)
        ->where('is_worker',0)
        ->whereNull('ragione_sociale')
        ->orWhereNull('is_admin')
        ->whereNull('is_worker')
        ->whereNull('ragione_sociale')
        ->sortable()->paginate(5);

        $aziende = User::
        where('is_admin',0)
        ->where('is_worker',0)
        ->whereNotNull('ragione_sociale')
        ->orWhereNull('is_admin')
        ->whereNull('is_worker')
        ->whereNotNull('ragione_sociale')
        ->sortable()->paginate(5);

        $worker = User::
        where('is_admin',0)
        ->where('is_worker',1)
        ->whereNull('ragione_sociale')
        ->orWhereNull('is_admin')
        ->whereNotNull('is_worker')
        ->whereNotNull('ragione_sociale')
        ->sortable()->paginate(5);
        
        return view('admin.showUser', compact('users', 'aziende', 'worker'));
    }

    public function editRole(Request $request, $id) {
        if ($request->is_worker == "on") {
            $checkbox = 1;
        } elseif ($request->is_worker == null) {
            $checkbox = 0;
        }
        $users = User::find($id);
        $users->is_worker = $checkbox;
        $users->is_admin = 0;
        $users->push();
        return redirect()->route('admin.showUser', $users);
    }

    public function editData(Request $request, $id) {
        $users = User::find($id);
        $users->pec = $request->pec;
        $users->telefono = $request->telefono;
        $users->indirizzo = $request->indirizzo;
        $users->codice_fiscale = $request->codice_fiscale;
        $users->citta = $request->citta;
        $users->cap = $request->cap;
        $users->comune = $request->comune;
        $users->provincia = $request->provincia;
        $users->partita_iva = $request->partita_iva;
        $users->ragione_sociale = $request->ragione_sociale;
        $users->push();
        return redirect()->route('admin.showUser', $users);
    }
}
