@extends('layouts.app')

@section('content')

<div class="container shadow bg-light p-5 rounded">
    @if ($products->count())


    <div class="d-flex mb-3">

      <button id="button" class="btn btn-danger mx-auto">Vai alla tabella</button>
    </div>

    <div class="container d-flex flex-wrap mb-5">

    @foreach ($searches as $item)

      @php
        $pesoSingolo = $item->peso;
        $pesoTotale = $item->peso * $item->quantita; 
      @endphp

      <div class="d-flex flex-wrap mx-auto">
         <div class="card shadow " style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title">Nome prodotto: <br>  <strong>{{$item->name}}.</strong></h5>
            <p class="card-text">Quantità Bloccata <strong>{{$item->quantita_bloccata}}</strong> su <strong>{{$item->quantita}} Totale</strong></p>
            <p class="card-text">Peso al pezzo <strong>{{$item->peso}} kg/l</strong></p>
            <p class="card-text">Peso Totale <strong>{{$pesoTotale}} kg/l</strong></p>
            
            <p class="card-text">Codice prodotto: <strong>{{$item->codice_prodotto}}</strong></p>
          </div>
        </div>
      </div>


    @endforeach

  </div>
      <div id="tableScroll" class="overflow-auto table-responsive-sm px-3">
        <table class="table border shadow  table-bordered table-hover table-sm ">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Settore</th>
                <th scope="col">Scaffale</th>
                <th scope="col">Lotto</th>
                <th scope="col">Scadenza</th>

                <th scope="col">Azioni</th>

              </tr>
            </thead>
            <tbody>
              
                  @foreach ($products as $product)
                  <tr >
                    <td>{{$product->sector->settore}}</td>
                    <td>{{$product->sector->scaffale}}</td>
                    <td>{{$product->lotto}}</td>
                    <td>{{$product->data_di_scadenza}}</td>
                    {{-- action --}}
                    <td>
                        <a href="{{route("worker.edit", $product->id)}}" class="btn btn-primary rounded"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal{{$product->id}}">
                          <i class="fas fa-truck"></i>
                        </button>
                        {{-- modal  --}}
                        <div class="modal fade" id="modal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Quant oggetti stai lasciando?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                
                                <form action="{{route('worker.test', $product->id)}}" method="post" enctype="multipart/form-data">
                                  @csrf
                                  @method('put')
                                  <div class="form-row">
                                    <div class="form-group">
                                      @if ($product->sector->quantita_bloccata > 0)
                                      <div class="alert alert-danger">
                                        <strong> <i class="fas fa-marker"></i> Attenzione {{$product->sector->quantita_bloccata}} pezzi sono stati già ordinati. <br> In caso i pezzi non bastassere per completere il tuo ordine prendine da un altro stock. </strong>
                                      </div>
                                      @endif
                                      <label for="quantita_rimanente">Quantità rimanente</label>
                                      <input name="quantita_rimanente" type="number"  class="form-control code-scanner quantita_rimanente" value="{{$product->sector->quantita_rimanente}}">
                                      @error('quantita_rimanente')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                      
                                      <label for="quantita_di_cartoni">quantita di Cartoni</label>
                                      <input name="quantita_di_cartoni" type="number"  class="form-control code-scanner quantita_di_cartoni" value="{{$product->sector->quantita_di_cartoni}}">
                                      @error('quantita_di_cartoni')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                    <div>
                                      <input hidden name="quantita_a_cartone" type="number"  class="form-control quantita_a_cartone" value="{{old("quantita_a_cartone") ? old("quantita_a_cartone") : $product->sector->quantita_a_cartone}}" >
                                    </div>
                                  </div>
        
                                
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>
                        {{-- modal  --}}

                    </td>
                    {{-- action --}}

              </tr>

                  @endforeach

              
             
            </tbody>
          </table>
        </div>
        @else
    <h2 class="text-center">Nessun record trovato nel magazzino </h2>

    @endif

    
</div>
<script type="text/javascript">
  $( document ).ready(function() {
    console.log( "ready!" );

  
 $(".quantita_di_cartoni").on('change', function () {
      var quantitaAttuale = $(this).val()
  console.log(quantitaAttuale);
      
      var quantitaRimanente = quantitaAttuale * $(".quantita_a_cartone").val();
      console.log(quantitaRimanente);

      $(".quantita_rimanente").val(quantitaRimanente)
   });
  
   $("#button").click(function() {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#tableScroll").offset().top
    }, 1000);
  });
});
</script>
@endsection