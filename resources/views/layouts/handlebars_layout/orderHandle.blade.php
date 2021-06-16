<script id="products-template" type="text/x-handlebars-template">
<div class="py-3">

    <h5> lotto @{{lotto}}</h5>
    
    <form action="http://localhost:8000/admin/ordersQuantity/@{{id}}" method="post">
        @csrf
        @method('PUT')

        <h5>Quantita totale  @{{quantita}}</h5>
        <div class="alert alert-warning" role="alert">
            Attualmente ci sono <strong>@{{quantita_bloccata}} </strong> elementi ordinati su  <strong>@{{quantita}}</strong>
          </div>
        <div class="form-group row">

            <label for="bloccata@{{id}}" class="col-md-4 col-form-label text-md-right">Inserire il numero di oggetti singoli</label>

            <div class="col-md-6">
                <input id="bloccata@{{id}}" type="number" max="@{{quantita_dif}}" class="form-control" name="quantita_bloccata" value="" required >

            </div>
        </div>
        <button type="submit" class="btn btn-primary">Ordina</button>
    </form>
        <h5 class="py-1">Soltanto in caso di errore cliccare per modificare</h5>
        <a class="btn btn-primary rounded my-2" href="http://localhost:8000/worker/@{{id}}/edit"><i class="fas fa-edit"></i></a>
      <hr> 
</div>

</script>
