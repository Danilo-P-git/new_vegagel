@extends('layouts.app')

@section('content')

<div class="container shadow bg-light p-5 rounded">
    <form action="{{route('worker.update', $product->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')
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
    
      {{-- form row  --}}

  <div class="form-row">
    <div class="form-group col-md-5 col-4">
      
      <label for="codice_prodotto">codice prodotto</label>
      <input name="codice_prodotto" type="text" id="codice_prodotto" class="form-control code-scanner" value="{{old("codice_prodotto") ? old("codice_prodotto") : $product->codice_prodotto}}">
      @error('codice_prodotto')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-5 col-4">
      <label for="codice_stock">codice stock</label>
      <input name="codice_stock" type="text" id="codice_stock" class="form-control code-scanner" value="{{old("codice_stock") ? old("codice_stock") : $product->codice_stock}}">
      @error('codice_stock')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-2 col-4">
      
      <label for="lotto">Lotto</label>
      <input name="lotto" type="text" id="lotto" class="form-control code-scanner" value="{{old("lotto") ? old("lotto") : $product->lotto}}">
      @error('lotto')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    
    
  </div>

      {{-- form row  --}}

  <div class="form-row">

    <div class="form-group col-md-4 col-4">
      <label for="scaffale">scaffale</label>
      <input name="scaffale" type="text"  id="scaffale" class="form-control" value="{{old("scaffale") ? old("scaffale") : $product->sector->scaffale}}">
      @error('scaffale')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="form-group col-md-4 col-4">
      <label for="quantita_rimanente">Quantità totale</label>
      <input name="quantita_rimanente" type="number"  id="quantita_rimanente" class="form-control" value="{{old("quantita_rimanente") ? old("quantita_rimanente") : $product->sector->quantita_rimanente}}"> 
      @error('quantita_rimanente')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-4 col-4">
      <label for="data_di_scadenza">data_di_scadenza</label>
      <input name="data_di_scadenza" type="date" id="data_di_scadenza" class="form-control" value="{{old("data_di_scadenza") ? old("data_di_scadenza") : $product->data_di_scadenza}}" >
      @error('data_di_scadenza')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
      {{-- form row  --}}

      {{-- form row  --}}

  <div class="form-row">

    <div class="form-group col-md-4 col-4">
      <label for="name">name</label>
      <input name="name" type="text" class="form-control" id="name" value="{{old("name") ? old("name") : $product->name}}">
      @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-4 col-4">
      <label for="description">description</label>
      <input name="description" type="text" class="form-control" id="description" value="{{old("description") ? old("description") : $product->description}}">
      @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-4 col-4">
      


        <label for="quantita_di_cartoni" class="ml-3">Numero di cartoni</label>
        <input name="quantita_di_cartoni" type="number" id="quantita_di_cartoni" class="form-control code-scanner" value="{{old("quantita_di_cartoni") ? old("quantita_di_cartoni") : $product->sector->quantita_di_cartoni}}">


      @error('quantita_di_cartoni')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>
  </div>

    {{-- form row  --}}


    {{-- form row  --}}

  <div class="form-row">
    <div class="form-group col-md-3 col-3">
      
      <label for="prezzo_al_pezzo">Prezzo al pezzo</label>
      <input name="prezzo_al_pezzo" type="number" id="prezzo_al_pezzo" class="form-control code-scanner" value="{{old("prezzo_al_pezzo") ? old("prezzo_al_pezzo") : $product->prezzo_al_pezzo}}">
      @error('prezzo_al_pezzo')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-3 col-3">
      <label for="prezzo_al_kg">Prezzo al kg</label>
      <input name="prezzo_al_kg" type="number" step=0.01 class="form-control" id="prezzo_al_kg" value="{{old("prezzo_al_kg") ? old("prezzo_al_kg") : $product->prezzo_al_kg}}">
      @error('prezzo_al_kg')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    
    <div class="form-group col-md-3 col-3">
      <label for="settore">settore</label>
      <input name="settore" type="text" class="form-control" id="settore" value="{{old("settore") ? old("settore") : $product->sector->settore}}">
      @error('settore')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-3 col-3">
      <label for="peso">Peso (KG)</label>
      <input name="peso" type="text" class="form-control" id="peso" value="{{old("peso") ? old("peso") : $product->peso}}">
      @error('peso')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div>
    <input hidden name="quantita_a_cartone" type="number" id="quantita_a_cartone" class="form-control" value="{{old("quantita_a_cartone") ? old("quantita_a_cartone") : $product->sector->quantita_a_cartone}}" >
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


   $("#quantita_di_cartoni").on('change', function () {
      var quantitaAttuale = $(this).val()
      var quantitaRimanente = quantitaAttuale * $("#quantita_a_cartone").val();
      $("#quantita_rimanente").val(quantitaRimanente)
   });

   

  </script>
@endsection
