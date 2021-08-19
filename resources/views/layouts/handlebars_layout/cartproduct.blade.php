
@if (Auth::User() == false )
<h2>accedi</h2>
<li><a href="{{route('register')}}"></a>Accedi</li>
<p>oppure</p><br>
<li><a href="{{route('login')}}"></a>Registrati</li>

@else
    


    


<script id="products-template" type="text/x-handlebars-template">


<div class="py-3">
    <h3> Lotto <strong>@{{lotto}} </strong></h3>
        
    <h4><span class="d-none dot stato@{{id}} mr-2 mt-1"></span><strong> Data di scadenza  @{{data_di_scadenza}} </strong></h4>
    <h5 class="d-none text-danger scaduto@{{id}}">Attenzione il prodotto è scaduto è consigliato cancellarlo manualmente. <br>
    Il prodotto si trova attualmente nel settore @{{settore}} all'interno dell'area @{{area}}</h5>
    <h5   class="d-none text-danger quasi-scaduto@{{id}}">Attenzione il prodotto sta per scadere.</h5>
    <h5>Prezzo al pezzo <strong> @{{prezzo_al_pezzo}}</strong> €</h5>
    <h5>Un singolo elemento equivale a <strong> @{{peso}} kg/l</strong></h5>
    <form action="{{env('APP_URL')}}/ecommerce/ordersQuantity/@{{id}}" method="post">
        @csrf
        @method('PUT')

        
        <h5>Quantita totale  @{{quantita}}</h5>
        <div class="alert alert-warning" role="alert">
           <p> Attualmente ci sono <strong>@{{quantita_bloccata}} </strong> elementi ordinati su  <strong>@{{quantita}}</strong></p>
        </div>
        <p id="peso@{{id}}"></p>
        <div class="form-group row">

            <label for="bloccata@{{id}}" class="col-md-4 col-form-label text-md-right">Inserire il numero di oggetti singoli</label>

            <div class="col-md-6">
                <input id="bloccata@{{id}}" type="number" max="@{{quantita_dif}}" class="form-control" name="quantita_bloccata" value="" required >
               

            </div>
        </div>
        <button type="submit" class="btn btn-primary">Ordina</button><br>
        <label for="data_di_consegna">Inserisci una data di consegna</label>
            <input name="data_di_consegna" type="date" id="data_di_consegna" class="form-control" style="width: 45%" required value="" >
        <input name="user" value="{{Auth::User()->name}}"hidden>
        <input name="zona" value="1" hidden>
    </form>
        <h5 class="py-1">Soltanto in caso di errore cliccare per modificare</h5>
        <a class="btn btn-primary rounded my-2" href="{{env('APP_URL')}}/worker/@{{id}}/edit"><i class="fas fa-edit"></i></a>
      <hr> 
</div>

</script>
@endif
