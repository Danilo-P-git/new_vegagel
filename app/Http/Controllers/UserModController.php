<?php

namespace App\Http\Controllers;

use App\Fornitori;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Sortable;


class UserModController extends Controller
{
    // separazione degli utenti in base ai loro dati 
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

        $fornitori= Fornitori::
        where('is_supplier',1)
        ->whereNull('ragione_sociale')
        ->sortable()->paginate(5);


        
        
        
        return view('admin.showUser', compact('users', 'aziende', 'worker','fornitori'));
    }
    // possibilità di poter far diventare un utente lavoratore e viceversa
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
    // Possibilità di far diventare un azienda un lavoratore o un utente
    public function editData(Request $request, $id) {
        $request->validate([
            'pec' => "required|max:191",
            'telefono' => "required|max:15",
            'indirizzo' => "required|max:191",
            'codice_fiscale'=> "required|max:20",
            'citta'=> "required|max:191",
            'comune'=> "required|max:191",
            'provincia'=> "required|max:191",
            'partita_iva'=> 'required|max:191',
            'ragione_sociale' => 'required|max:191',
             
                ],
    [
        'pec.required'=> 'Inserisci la mail PEC',
        'pec.max'=> 'Mail troppo lunga',
        'telefono.required'=> 'Inserisci il numero di telefono di riferimento',
        'telefono.max'=> 'Numero troppo lungo',
        'indirizzo.required'=> 'Inserisci un indirizzo',
        'codice_fiscale.required'=> 'Inserisci il codice_fiscale dell &apos; azienda',
        'codice_fiscale.max' => 'Codice fiscale troppo lungo',
        'citta.required'=> 'Inserisci la città',
        'citta.min'=> 'Inserisci la città',
        'comune.required'=>'Inserisci il comune',
        'comune.max'=>'Il nome del comune è troppo lungo',
        'provincia.required'=> 'Inserisci la provincia',
        'provincia.max'=> 'Nome provincia troppo lungo',
        'partita_iva.required'=> 'Inserisci la partita Iva',
        'partita_iva.max'=> 'Partita iva troppo lunga',
        'ragione_sociale.required'=> 'Inserisci la ragione Sociale',
        'ragione_sociale.max'=> 'Nome ragione sociale troppo lunga'           
    
    ]);
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
        $users->num_documento = $request->num_documento;
        $users->ragione_sociale = $request->ragione_sociale;
        $users->push();
        return redirect()->route('admin.showUser', $users);
    }

    
    // Creazione da zero dell'user 
    public function createUser(Request $request){
        
        if ($request->is_worker == "on") {
            $checkbox = 1;
        } elseif ($request->is_worker == null) {
            $checkbox = 0;
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('PasswordDefault');
        $user->pec = $request->pec;
        $user->telefono = $request->telefono;
        $user->indirizzo = $request->indirizzo;
        $user->codice_fiscale = $request->codice_fiscale;
        $user->citta = $request->citta;
        $user->cap = $request->cap;
        $user->provincia = $request->provincia;
        $user->partita_iva = $request->partita_iva;
        $user->num_documento = $request->num_documento;
        $user->ragione_sociale = $request->ragione_sociale;
        $user->is_worker = $checkbox;
        $user->is_admin = 0;
        $user->save();

        return redirect()->route('admin.showUser');



    }

    public function createFornitori(Request $request){
        
       
        $user = new Fornitori;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('PasswordDefault');
        $user->pec = $request->pec;
        $user->telefono = $request->telefono;
        $user->indirizzo = $request->indirizzo;
        $user->codice_fiscale = $request->codice_fiscale;
        $user->citta = $request->citta;
        $user->cap = $request->cap;
        $user->provincia = $request->provincia;
        $user->partita_iva = $request->partita_iva;
        $user->num_documento = $request->num_documento;
        $user->ragione_sociale = $request->ragione_sociale;
        $user->is_supplier = 1;
        $user->save();

        return redirect()->route('admin.showUser');
    }
}
