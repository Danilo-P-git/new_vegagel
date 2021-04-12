@extends('layouts.app')

@section('content')


<div class="container">


    @foreach ($products as $product)
    <div class="card" style="width: 18rem;">
        <div class="card-body">
        <h5 class="card-title">{{$product->name}}</h5>
        <p class="card-text">{{$product->codice_prodotto}}</p>
        <p class="card-text">{{$product->products_id}}</p>

        <a href="#" class="btn btn-primary">action</a>
        </div>
    </div>
    @endforeach
</div>
@endsection