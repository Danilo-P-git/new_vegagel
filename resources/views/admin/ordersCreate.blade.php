@extends('layouts.side')

@section('content')
{{-- @dd(session()->get('cart')) --}}
<div class="container-sm  bg-light shadow p-1 px-lg-5 rounded">


    <div class="overflow-auto p-2">
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        @if (Session::has('cart'))
            
        
        @php 
        
        $cart = session()->get('cart')
        
        @endphp


        <h2>Ordine in creazione</h2>
        <div class="overflow-auto p-2" style="width: 100%">
            <table class="table border shadow table-bordered table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome prodotto</th>
                        <th>Codice prodotto</th>
                        <th>Quantita</th>
                        <th>Lotto</th>
                        <th>creato da:</th>
                        <th>Azioni</th>
                        <th>Prezzo al pezzo</th>
                        <th>Prezzo al Kg</th>
                        
                    </tr>
                    
                </thead>
                <tbody>
                    @foreach ($cart as $key =>$item )
                    @if ($item['zona']='interno')
                        
                    
                    
                    <tr>
                        <td>{{$item['nome']}}</td>
                        <td>{{$item['codice_prodotto']}}</td>
                        <td>{{$item['quantita']}}</td>
                        <td>{{$item['lotto']}}</td>
                        <td>{{$item['user']}}</td>
                        <td><a href="{{route('admin.orderDelete', $key)}}">Cancella</a></td>
                        <td>{{$item['prezzoPezzo']}} €</td>
                        <td>{{$item['prezzoKg']}} €</td>
                    </tr>
                    <?php 
                    $totalePezzo=0;
                    $totaleKg=0;
                    foreach ($cart as $key => $value) {
                        $totalePezzo += $value['prezzoPezzo'] * $value['quantita'];
                        $totaleKg += $value['prezzoKg'] * $value['quantita'];
                    }
                ?>
                    <input type="number" id="prezzoPezzo" value="{{$totalePezzo}}" hidden>
                    <input type="number" id="prezzoKg" value="{{$totaleKg}}" hidden>
                    
                    
                    @endif 
                    @endforeach  
                </tbody>
                
                <thead class="thead-dark">
                    <tr>
                        <th style="font-size: 25px;color:#f4c543;text-align:start;">TOTALE</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th name="sconto" style="font-size: 20px;color:#f4c543;text-align:start;">€</th>
                        <th name="sconto2" style="font-size: 20px;color:#f4c543;text-align:start;">€</th>

                    </tr>
                    
                </thead>
            </table>
            
        </div>
        <form action="{{route('admin.orderSend')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="py-2" style="width: 100%">

                <p>Seleziona un utente</p>
                <select id="userSelect" name="user" class="custom-select" style="width: 50%" required>
                    
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->ragione_sociale}}</option>
                        
                    @endforeach
                </select><br><br>
                <p>Seleziona Listino Sconto</p>
                <select class="form-select" name="listini" id="listini">
                    <option value="0" selected>---</option>
                    <option value="1.5">Listino 1 - 1.5%</option>
                    <option value="2">Listino 2 - 2%</option></select></td>
                </select>

            </div>
            <label for="data_di_consegna">Inserisci una data di consegna</label>
            <input name="data_di_consegna" type="date" id="data_di_consegna" class="form-control" style="width: 25%" required value="" >
            <input name="totalePezzo" type="number" style="width: 25%" required value="{{$totalePezzo}}" hidden >
            <input name="totaleKg" type="number" style="width: 25%" required value="{{$totaleKg}}" hidden >
            <button type="submit" class="btn btn-primary my-2">Invia ordine</button>
        </form>
        @endif
        <div class="p-2">
            <div class="card border-primary">
              <div class="card-body">
                <h4 class="card-title text-center">Leggenda</h4>
                <p class="card-text"><span class="dot  bg-warning mr-2 mt-1"></span> <strong> Meno di un mese alla scadenza </strong></p>
                <p class="card-text"><span class="dot bg-danger mr-2 mt-1"></span><strong>Scaduto</strong></p>
                <p class="card-text"><a href="" class="btn btn-primary"><i class="fa fa-truck" aria-hidden="true"></i></a> <strong>Inserisci nell'ordine</strong></p>
                <p class="card-text"><a href="" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a> <strong>Ulteriori informazioni</strong></p>
    
                {{-- <p class="card-text"><span class="dot"></span></p> --}}
    
              </div>
            </div>
        </div>
        <div class="form-row mt-5">
            <div class="form-group col-md-4 col-6">
            
                <input type="text" class="form-control" id="search" placeholder="Type to search..." />
            </div>
        </div>
        <table id="table" class="table border shadow table-bordered table-hover table-sm" >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome prodotto</th>
                    <th class="d-none d-md-table-cell" scope="col">Codice prodotto</th>
                    {{-- <th scope="col">Data di scadenza</th> --}}
                    <th scope="col">Quantita disponibile</th>
                    <th scope="col">Quantita bloccata</th>
                    <th>
                        Azioni
                    </th>
                </tr>

            </thead>

            <tbody>
                @foreach ($products as $item )
                    
                    {{-- @php
                        $scadenza = $item->data_di_scadenza;
                        
                        if ($scadenza<$today) {
                            $classe = 'table-danger';
                        } else if ($scadenza>$today && $scadenza < $traUnMese)
                        {
                            $classe = 'table-warning';
                        } else {
                            $classe= '';
                        }
                        
                    @endphp --}}
                    <tr class="">
                        <td>{{$item->name}}</td>
                        <td class="d-none d-md-table-cell">{{$item->codice_prodotto}}</td>
                        {{-- <td>{{$item->data_di_scadenza}}</td> --}}
                        <td>{{$item->quantita}}</td>
                        <td>{{$item->bloccata}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary rounded products" data-toggle="modal" data-target="#prod{{$item->codice_prodotto}}" value="{{$item->codice_prodotto}}">
                                <i class="fas fa-truck"></i>
                            </button>
                            
                            
                            <!-- Modal -->
                            <div class="modal fade" id="prod{{$item->codice_prodotto}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Elementi</h5>
                                                <button class="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body element-wrapper">
                                            sada
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary rounded info" data-toggle="modal" data-target="#info{{$item->codice_prodotto}}" value="{{$item->codice_prodotto}}">
                                <i class="fas fa-eye"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="info{{$item->codice_prodotto}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Elementi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body element-wrapper">
                                            @php
                                                $quantita = $item->quantita;
                                                $pesoTotale = $item->peso * $quantita;
                                                $bloccata = $item->bloccata;
                                                $pesoBloccata = $item->peso * $bloccata
                                            @endphp
                                            <p>Peso totale {{$pesoTotale}} Kg/l </p>
                                            <p>bloccati {{$pesoBloccata}} Kg/l</p>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

<script>
     
    // Write on keyup event of keyword input element
    $("#search").keyup(function(){
        var searchText = $(this).val().toLowerCase();
        // Show only matching TR, hide rest of them
        $.each($("#table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf(searchText) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
    }); 
</script>
<script>
    $("#listini").change(function () {
    var perc = parseFloat($("#prezzoPezzo").val());
    var perc2 = parseFloat($("#prezzoKg").val());
    var purch = parseFloat($("#listini").val());

   /* $("#prezzoPezzo").val((purch * perc)/(100).toFixed(2)); */
   let sconto1=(purch/100)*(perc);
   let sconto2=(purch/100)*(perc2);
   let tot=(perc-sconto1).toFixed(2);
   let tot2=(perc2-sconto2).toFixed(2);
   

    let x = document.getElementsByName("sconto");
    let i;

    for (i = 0; i < x.length; i++) {
        x[i].innerHTML ='<s>'+perc+' €'+'</s>'+ '<br>'+'  ' +tot + ' €';
    }
    let x2 = document.getElementsByName("sconto2");
    let i2;

    for (i2 = 0; i2 < x.length; i2++) {
        x2[i2].innerHTML = '<s>'+perc2+' €'+'</s>'+ '<br>'+'  ' +tot2 + ' €';

    }
   /* document.getElementsByName("sconto")[0].innerHTML = tot + ' €'; */
   
});

</script>
@include('layouts.handlebars_layout.orderHandle')


@endsection
