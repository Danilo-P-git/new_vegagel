@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{route('worker.update', $product->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')
  <div class="form-row">

      <div class="form-group col-md-6 col-6">
      <label for="codice_prodotto">codice prodotto</label>
      <input name="codice_prodotto" type="number" id="codice_prodotto"  class="form-control" value="{{$product->codice_prodotto}}">
      @error('codice_prodotto')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-6 col-6">
      <label for="codice_stock">codice stock</label>
      <input name="codice_stock" type="number" id="codice_stock"  class="form-control" value="{{$product->codice_stock}}" >
      @error('codice_stock')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
  </div>  
  
  <div class="form-row">

    <div class="form-group col-md-4 col-4">
      <label for="scaffale">scaffale</label>
      <input name="scaffale" type="text"  id="scaffale" class="form-control" value="{{$product->sector->scaffale}}">
      @error('scaffale')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="form-group col-md-4 col-4">
      <label for="quantita_rimanente">quantita_rimanente</label>
      <input name="quantita_rimanente" type="number"  id="quantita_rimanente" class="form-control" value="{{$product->sector->quantita_rimanente}}"> 
      @error('quantita_rimanente')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-4 col-4">
      <label for="data_di_scadenza">data_di_scadenza</label>
      <input name="data_di_scadenza" type="date"  id="data_di_scadenza" class="form-control" value="{{$product->data_di_scadenza}}" >
      @error('data_di_scadenza')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
  </div>

  <div class="form-row">

    <div class="form-group col-md-6 col-6">
      <label for="name">name</label>
      <input name="name" type="text"  class="form-control" value="{{$product->name}}" id="name">
      @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="form-group col-md-6 col-6">
      <label for="description">description</label>
      <input name="description" type="text" class="form-control" value="{{$product->description}}" id="description">
      @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

  </div>

  <div class="form-row">
  
    <div class="form-group col-md-6 col-6">
      <label for="costo">costo</label>
      <input name="costo" type="number" step=0.01 class="form-control" value="{{$product->costo}}" id="costo">
      @error('costo')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    
    <div class="form-group col-md-6 col-6">
      <label for="settore">settore</label>
      <input name="settore" type="text"  class="form-control" value="{{$product->sector->settore}}" id="settore">
      @error('settore')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
  </div>


  <button type="submit" class="btn btn-primary">Sposta</button>
  </form>
  </div>



  <script type="text/javascript">

   $("form").keydown(function (e) {
       if (e.keyCode == 13) {
           e.preventDefault();
           return false;
       }
   });
  </script>
@endsection
