@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{route('worker.update', $product->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')
    <div class="form-group">
    <label for="codice_prodotto">codice prodotto</label>
    <input name="codice_prodotto" type="number" id="codice_prodotto" disabled class="form-control" value="{{$product->codice_prodotto}}">
  </div>
  <div class="form-group">
    <label for="codice_stock">codice stock</label>
    <input name="codice_stock" type="number" id="codice_stock" disabled class="form-control" value="{{$product->codice_stock}}" >
  </div>
  <div class="form-group">
    <label for="scaffale">scaffale</label>
    <input name="scaffale" type="text"  id="scaffale" class="form-control" value="{{$product->sector->scaffale}}">
  </div>

  <div class="form-group">
    <label for="quantita_rimanente">quantita_rimanente</label>
    <input name="quantita_rimanente" type="number"  id="quantita_rimanente" class="form-control" value="{{$product->sector->quantita_rimanente}}"> 
  </div>
  <div class="form-group">
    <label for="data_di_scadenza">data_di_scadenza</label>
    <input name="data_di_scadenza" type="date" disabled id="data_di_scadenza" class="form-control" value="{{$product->data_di_scadenza}}" >
  </div>

  <div class="form-group">
    <label for="name">name</label>
    <input name="name" type="text"  class="form-control" value="{{$product->name}}" id="name">
  </div>

  <div class="form-group">
    <label for="description">description</label>
    <input name="description" type="text" class="form-control" value="{{$product->description}}" id="description">
  </div>

  <div class="form-group">
    <label for="costo">costo</label>
    <input name="costo" type="number" step=0.01 class="form-control" value="{{$product->costo}}" id="costo">
  </div>
  
  <div class="form-group">
    <label for="settore">settore</label>
    <input name="settore" type="text"  class="form-control" value="{{$product->sector->settore}}" id="settore">
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>

@endsection
