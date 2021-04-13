@extends('layouts.app')

@section('content')


<div class="container d-flex flex-wrap">
    <div>
        <a href="{{route("worker.create")}}" class="btn btn-success"> Scarico merci</a>
    </div>
    <div>
    </div>

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
        <a href="{{ route("worker.show", $product->id) }}" class="btn btn-primary">Mostra</a>
        <a href="{{route("worker.edit", $product->id)}}" class="btn btn-danger">Modifica</a>

        </div>
    </div>
    @endforeach
</div>
@endsection
