@extends('layouts.app')

@section('content')


<div class="container">


    
    <form action="{{route('worker.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('POST')
    <div class="form-group">
      <div class="input-field">
        <label for="isbn_input">EAN:</label>
        <input id="isbn_input" class="isbn" type="text" />
        <button type="button" class="icon-barcode button scan">scansiona</button>
    </div>
    <label for="codice_prodotto">codice prodotto</label>
    <input name="codice_prodotto" type="number" id="codice_prodotto" class="form-control">
  </div>
  <div class="form-group">
    <label for="codice_stock">codice stock</label>
    <input name="codice_stock" type="number" id="codice_stock" class="form-control" >
  </div>
  <div class="form-group">
    <label for="scaffale">scaffale</label>
    <input name="scaffale" type="text"  id="scaffale" class="form-control">
  </div>

  <div class="form-group">
    <label for="quantita_rimanente">quantita_rimanente</label>
    <input name="quantita_rimanente" type="number"  id="quantita_rimanente" class="form-control"> 
  </div>
  <div class="form-group">
    <label for="data_di_scadenza">data_di_scadenza</label>
    <input name="data_di_scadenza" type="date" id="data_di_scadenza" class="form-control" >
  </div>

  <div class="form-group">
    <label for="name">name</label>
    <input name="name" type="text" class="form-control" id="name">
  </div>

  <div class="form-group">
    <label for="description">description</label>
    <input name="description" type="text" class="form-control" id="description">
  </div>

  <div class="form-group">
    <label for="costo">costo</label>
    <input name="costo" type="number" step=0.01 class="form-control" id="costo">
  </div>
  
  <div class="form-group">
    <label for="settore">settore</label>
    <input name="settore" type="text" class="form-control" id="settore">
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>


@endsection