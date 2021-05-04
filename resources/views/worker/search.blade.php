@extends('layouts.app')

@section('content')

<div class="container">
    @if ($products->count())


    <div class="d-flex mb-3">

      <button id="button" class="btn btn-danger mx-auto">Vai alla tabella</button>
    </div>

    <div class="container d-flex flex-wrap mb-5">

    @foreach ($searches as $item)



      <div class="d-flex flex-wrap mx-auto">
         <div class="card shadow " style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title">Nome prodotto: <br>  <b>{{$item->name}}.</b></h5>
            <p class="card-text">Totale in magazzino: <b>{{$item->quantita}}</b></p>
            <p class="card-text">Codice prodotto: <b>{{$item->codice_prodotto}}</b></p>
          </div>
        </div>
      </div>


    @endforeach

  </div>
      <div id="tableScroll" class="overflow-auto table-responsive-sm">
        <table class="table border shadow  table-bordered table-hover table-sm ">
            <thead class="thead-dark">
              <tr>
                <th scope="col" >@sortablelink('sector.settore', 'Settore')</th>
                <th scope="col">@sortablelink('sector.scaffale', 'scaffale')</th>
                {{-- <th scope="col" data-breakpoints="md">@sortablelink('codice_prodotto', 'Codice Prodotto')</th> --}}
                <th scope="col" data-breakpoints="md">@sortablelink('lotto', 'Lotto')</th>

                {{-- <th scope="col" data-breakpoints="md">@sortablelink('name', 'Nome')</th> --}}
                {{-- <th scope="col">@sortablelink('created_at', 'Arrivato il')</th>
                <th scope="col">@sortablelink('updated_at', 'Spostato il')</th> --}}
                <th scope="col">@sortablelink('data_di_scadenza', 'scadenza')</th>
                {{-- <th scope="col">Quantita totale</th> --}}
                {{-- <th scope="col">Quantita di Cartoni</th> --}}
                <th scope="col">Azioni</th>

              </tr>
            </thead>
            <tbody>
              
                  @foreach ($products as $product)
                  <tr >
                    <td>{{$product->sector->settore}}</td>
                    <td>{{$product->sector->scaffale}}</td>
                    {{-- <td>{{$product->codice_prodotto}}</td> --}}
                    <td>{{$product->lotto}}</td>
                    {{-- <td>{{$product->name}}</td> --}}
                    {{-- <td>{{$product->created_at}}</td>
                    <td>{{$product->updated_at}}</td> --}}
                    <td>{{$product->data_di_scadenza}}</td>
                    {{-- <td id="loop">{{$product->sector->quantita_rimanente}}</td> --}}
                    {{-- <td id="loop2">{{$product->sector->quantita_di_cartoni}}</td> --}}

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
                                      
                                      <label for="quantita_rimanente">Quantità rimanente</label>
                                      <input name="quantita_rimanente" type="number" id="quantita_rimanente" class="form-control code-scanner" value="{{$product->sector->quantita_rimanente}}">
                                      @error('quantita_rimanente')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                      
                                      <label for="quantita_di_cartoni">quantita di Cartoni</label>
                                      <input name="quantita_di_cartoni" type="number" id="quantita_di_cartoni" class="form-control code-scanner" value="{{$product->sector->quantita_di_cartoni}}">
                                      @error('quantita_di_cartoni')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                    <div>
                                      <input hidden name="quantita_a_cartone" type="number" id="quantita_a_cartone" class="form-control" value="{{old("quantita_a_cartone") ? old("quantita_a_cartone") : $product->sector->quantita_a_cartone}}" >
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

                        {{-- <a href="{{route("worker.test", $product->id)}}" class="btn btn-secondary mt-1"><i class="fas fa-eye"></i></a> --}}
                    </td>
                </tr>

                  @endforeach

              
             
            </tbody>
          </table>
        </div>
    

    @endif
</div>
<script type="text/javascript">
  

 $("#quantita_di_cartoni").on('change', function () {
      var quantitaAttuale = $(this).val()
      var quantitaRimanente = quantitaAttuale * $("#quantita_a_cartone").val();
      $("#quantita_rimanente").val(quantitaRimanente)
   });
  
   $("#button").click(function() {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#tableScroll").offset().top
    }, 1000);
  });
</script>
@endsection