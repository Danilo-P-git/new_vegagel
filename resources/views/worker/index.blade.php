@extends('layouts.app')

@section('content')


<div class="container d-flex flex-wrap">


    @foreach ($products as $product)
    <div class="card my-2 mx-2" style="width: 18rem;">
        <div class="card-body">
        <h5 class="card-title">{{$product->name}}</h5>
        <p class="card-text">{{$product->codice_prodotto}}</p>
        <div class="d-flex">
            <p class="card-text">{{$product->sector->scaffale}}</p>
            <p class="card-text ml-5">{{$product->sector->settore}}</p>
        </div>



        <a href="#" class="btn btn-primary">action</a>
        </div>
    </div>
    @endforeach
</div>
@endsection
