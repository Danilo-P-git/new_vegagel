<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Log extends Model
{
    use Sortable;
    public $sortable = [
        "id",
        "nome",
        "cognome",
        "azione",
        "codice_movimento",
        "created_at"

    ];
}
