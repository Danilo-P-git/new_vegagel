@extends('layouts.app')

@section('content')


<div class="container">


    
    <form action="{{route('worker.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('POST')


      <div class="card">
        
        <div class="card-body">
        
          <div class="row">
        
            <div class="col-xs-12 col-sm-12 col-md-6">
        
              <div id="interactive" class="viewport"></div>
        
            </div>
        
            <div class="col-xs-12 col-sm-12 col-md-6">
        
              <div id="result_strip">
        
              </div>
        
            </div>
        
          </div>
        
        </div>
      
      </div>
    
  <div class="form-row">
    <div class="form-group col-md-6 col-6">
      
      <label for="codice_prodotto">codice prodotto</label>
      <input name="codice_prodotto" type="number" id="codice_prodotto" class="form-control test">
    </div>
    <div class="form-group col-md-6 col-6">
      <label for="codice_stock">codice stock</label>
      <input name="codice_stock" type="number" id="codice_stock" class="form-control test" >
    </div>
  </div>
  <div class="form-row">

    <div class="form-group col-md-4 col-4">
      <label for="scaffale">scaffale</label>
      <input name="scaffale" type="text"  id="scaffale" class="form-control">
    </div>

    <div class="form-group col-md-4 col-4">
      <label for="quantita_rimanente">quantita_rimanente</label>
      <input name="quantita_rimanente" type="number"  id="quantita_rimanente" class="form-control"> 
    </div>
    <div class="form-group col-md-4 col-4">
      <label for="data_di_scadenza">data_di_scadenza</label>
      <input name="data_di_scadenza" type="date" id="data_di_scadenza" class="form-control" >
    </div>
  </div>
  <div class="form-row">

    <div class="form-group col-md-6 col-6">
      <label for="name">name</label>
      <input name="name" type="text" class="form-control" id="name">
    </div>

    <div class="form-group col-md-6 col-6">
      <label for="description">description</label>
      <input name="description" type="text" class="form-control" id="description">
    </div>
  </div>
  <div class="form-row">

    <div class="form-group col-md-6 col-6">
      <label for="costo">costo</label>
      <input name="costo" type="number" step=0.01 class="form-control" id="costo">
    </div>
    
    <div class="form-group col-md-6 col-6">
      <label for="settore">settore</label>
      <input name="settore" type="text" class="form-control" id="settore">
    </div>
  </div>


  <button type="submit" class="btn btn-primary">Scarica</button>
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