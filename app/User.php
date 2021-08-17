<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use Notifiable;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin','is_worker','pec', 'telefono','indirizzo','codice_fiscale','citta','cap','comune', 'provincia', 'partita_iva', 'ragione_sociale'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
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
        "ragione_sociale"

    ];

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function orderEcommerce(){
        return $this->hasMany(Order_Ecommerces::class);
    }
}
