@extends('layouts.side')

@section('content')
{{-- @dd(session()->get('cart')) --}}
<div class="container bg-light shadow p-5 rounded">


    <div class="overflow-auto p-2">
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        @if (Session::has('cart'))
            
        
        @php $cart = session()->get('cart')
        @endphp

        <h2>Ordine in creazione</h2>
        <div class="overflow-auto p-2" style="width: 50%">
            <table class="table border shadow table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome prodotto</th>
                        <th>Codice prodotto</th>
                        <th>Quantita</th>
                        <th>Lotto</th>
                        <th>Azioni</th>

                    </tr>
                    
                </thead>
                <tbody>
                    @foreach ($cart as $key =>$item )
                    
                    <tr>
                        <td>{{$item['nome']}}</td>
                        <td>{{$item['codice_prodotto']}}</td>
                        <td>{{$item['quantita']}}</td>
                        <td>{{$item['lotto']}}</td>
                        <td><a href="{{route('admin.orderDelete', $key)}}">Cancella</a></td>
                    </tr>
                    @endforeach   
                </tbody>
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
                </select>

            </div>
            <label for="data_di_consegna">Inserisci una data di consegna</label>
            <input name="data_di_consegna" type="date" id="data_di_consegna" class="form-control" style="width: 25%" required value="" >
            <button type="submit" class="btn btn-primary my-2">Invia ordine</button>
        </form>
        @endif
        <div class="form-row mt-5">
            <div class="form-group col-md-4 col-6">
            
                <input type="text" class="form-control" id="search" placeholder="Type to search..." />
            </div>
        </div>
        <table id="table" class="table border shadow table-bordered table-hover" >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome prodotto</th>
                    <th scope="col">Codice prodotto</th>
                    <th scope="col">Data di scadenza</th>
                    <th scope="col">Quantita disponibile</th>
                    <th scope="col">Quantita bloccata</th>
                    <th>
                        Azioni
                    </th>
                </tr>

            </thead>

            <tbody>
                @foreach ($products as $item )
                    
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->codice_prodotto}}</td>
                        <td>{{$item->data_di_scadenza}}</td>
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
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
@include('layouts.handlebars_layout.orderHandle')


@endsection
