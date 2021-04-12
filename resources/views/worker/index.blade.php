@extends('layouts.app')

@section('content')


<div class="container">


    @foreach ($products as $product)
    <div class="card" style="width: 18rem;">
        <div class="card-body">
        <h5 class="card-title">{{$product->name}}</h5>
        <p class="card-text">{{$product->codice_prodotto}}</p>

        {{-- <p class="card-text">{{$product->sectors->products_id}}</p> i've tried this and that gets' me this error
        Trying to get property 'products_id' of non-object         --}}

        {{-- <p class="card-text">{{$product->sectors['products_id']}}</p> i've tried this and that get's me this error
        Trying to access array offset on value of type null

        --}}

        <a href="#" class="btn btn-primary">action</a>
        </div>
    </div>
    @endforeach
</div>
@endsection
