<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Model;

class Fornitori extends Model
{
    use Notifiable;
    use Sortable;
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'pec', 
        'telefono',
        'indirizzo',
        'codice_fiscale',
        'citta',
        'cap',
        'comune', 
        'provincia', 
        'partita_iva', 
        'ragione_sociale',
        'is_supplier'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $sortable = [
        "name",
        "email",
        "pec",
        "telefono",
        "indirizzo",
        "codice_fiscale",
        "città",
        "comune",
        "provincia",
        "cap",
        "partita_iva",
        "ragione_sociale",
        'is_supplier'


    ];

    public function product(){
        return $this->hasMany('App\Product');
    }
}
