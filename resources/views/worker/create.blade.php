@extends('layouts.app')

@section('content')


<div class="container">
    <form action="{{route('worker.create')}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('POST')
    <div class="form-group">
    <label for="codice_prodotto">codice prodotto</label>
    <input name="codice_prodotto" type="text" id="codice_prodotto" class="form-control">
  </div>
  <div class="form-group">
    <label for="codice_stock">codice stock</label>
    <input name="codice_stock" type="text" id="codice_stock" class="form-control" >
  </div>
  <div class="form-group">
    <label for="data_di_scadenza">data_di_scadenza</label>
    <input name="data_di_scadenza" type="text" id="data_di_scadenza" class="form-control" >
  </div>

  <div class="form-group">
    <label for="name">name</label>
    <textarea name="name" class="form-control" id="name"> </textarea>
  </div>

  <div class="form-group">
    <label for="description">description</label>
    <textarea name="description" class="form-control" id="description"> </textarea>
  </div>

  <div class="form-group">
    <label for="costo">costo</label>
    <textarea name="costo" class="form-control" id="costo"> </textarea>
  </div>
  
  <div class="form-group">
    <label for="settore">settore</label>
    <textarea name="settore" class="form-control" id="settore"> </textarea>
  </div>

  <div class="form-group">
    <label for="scaffale">scaffale</label>
    <textarea name="scaffale" class="form-control" id="scaffale"> </textarea>
  </div>

  <div class="form-group">
    <label for="quantita_rimanente">quantita_rimanente</label>
    <textarea name="quantita_rimanente" class="form-control" id="quantita_rimanente"> </textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>


@endsection