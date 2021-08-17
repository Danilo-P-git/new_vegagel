@extends('layouts.side')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Nome: {{$item->name}}</h1>
            <h2>Descrizione: {{$item->description}}</h2>
            <h2>Codice Prodotto: {{$item->codice_prodotto}}</h2>
            <h2>Lotto: {{$item->lotto}}</h2>
            <h2>Data di scadenza: {{$item->data_di_scadenza}}</h2>
            <h2>Prezzo al pezzo: {{$item->prezzo_al_pezzo}}</h2>
            <h2>Prezzo al Kg: {{$item->prezzo_al_kg}}</h2>
            <h2>Peso: {{$item->peso}}</h2>
            <h2>Fornitore: {{$item->fornitori->name}}</h2>
        </div>
    </div>
</div>


@endsection