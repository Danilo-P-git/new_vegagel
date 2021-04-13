@extends('layouts.app')

@section('content')

<div class="container">

    
    <h2 class="text-align-center">{{$product->name}}</h2>

    <p>{{$product->codice_prodotto}}</p>

    <p>{{$product->codice_stock}}</p>

    <p>{{$sector->settore}}</p>
    <p>{{$sector->scaffale}}</p>
    <p>{{$sector->quantita_rimanente}}</p>
</div>


@endsection