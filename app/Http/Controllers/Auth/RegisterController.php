<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'pec' =>['nullable','string', 'email', 'max:255'],
            'telefono' =>['nullable','string', 'max:30'],
            'indirizzo' =>['nullable','string', 'max:255'],
            'codice_fiscale' =>['nullable','string', 'max:255'],
            'citta' =>['nullable','string', 'max:255'],
            'cap' =>['nullable','integer'],
            'comune' =>['nullable','string', 'max:255'],
            'provincia' =>['nullable','string', 'max:255'],
            'ragione_sociale' =>['nullable','string', 'max:255'],
            'is_admin' =>['nullable','boolean'],
            'is_worker' =>['nullable','boolean'],
            






        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'pec'=> $data['pec'],
            'telefono'=> $data['telefono'],
            'indirizzo'=> $data['indirizzo'],
            'codice_fiscale'=> $data['codice_fiscale'],
            'citta'=> $data['citta'],
            'cap'=> $data['cap'],
            'comune'=> $data['comune'],
            'provincia'=> $data['provincia'],
            'partita_iva'=> $data['partita_iva'],
            'partita_iva'=> $data['num_documento'],

            'ragione_sociale'=> $data['ragione_sociale'],
            'is_admin'=> null,
            'is_worker' => null








            
        ]);
    }
}
