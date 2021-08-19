@extends('ecommerce.side')

@section('content')

@if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        @if (Session::has('cart'))
            
        
        @php 
        
        $cart = session()->get('cart');

        /* dd($cart); */
        @endphp

@endif
<div class="container">
    <div class="row">
        <button type="button" class="btn btn-info ml-auto" data-toggle="dropdown">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
        </button>
    </div>
</div>
<div class="container shadow mt-5 my-5">
    <div class="row justify-content-center">
        @foreach ($products as $item)
        <div class="col-12 col-md-4 col-lg-6 col-xl-3 col-xs-12 m-5 ">
            <div class="card card-round">
                <form action="{{route('ecommerce.ordersCreate')}}" method="GET">
                    {{-- <img src="{{asset('storage/'.$item->photo)}}" class="card-img-top img-fluid mt-3 my-3" style="height:300px;object-fit: contain" alt="..."> --}}
                    <img src="https://via.placeholder.com/728.png?text=Immagine+segnaposto" class="card-img-top img-fluid mt-3 my-3" style="height:300px;object-fit: contain" alt="...">
                    <div class="card-body">
                        <h5 class="">Nome articolo: </h5>
                        <p style="color: #fd0000af">{{-- <input type="text" name="id" value="{{$item->id}}" hidden> --}}<strong>{{$item->name}}</strong></p>
                        <h5 class="card-text">Descrizione prodotto: </h5>
                        <p style="color: #fd0000af"><strong>{{$item->description}}</p></strong><hr>
                        <h5 class="card-text">Prezzo singolo: <strong><span style="color: #fd0000af">{{$item->prezzo_al_pezzo}} €</span></strong></h5>
                        <h5 class="card-text">Prezzo al Kg: <strong><span style="color: #fd0000af">{{$item->prezzo_al_kg}} €</span></strong></h5>
                        @if ($item->sector->quantita_rimanente - $item->sector->quantita_bloccata > 0)
                        <h5 class="card-text">Unità disponibili: <strong><span style="color: #fd0000af">{{$item->sector->quantita_rimanente - $item->sector->quantita_bloccata}}</span></strong></h5>
                            
                        @else
                        <h5 class="card-text">Unità disponibili: <strong><span style="color: #fd0000af">Esaurito!</span></strong></h5>

                        @endif
                                                    
                        <!-- Button trigger modal -->
                        @if (Auth::User() == false )
                        <div class="container">
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <a href="{{route('register')}}"><li class="btn btn-primary rounded products">Registrati</li></a>
                                </div>
                                <div class="col-6 col-md-6">
                                    <a href="{{route('login')}}"><li class="btn btn-primary rounded products">Accedi</li></a>
                                </div>
                            </div>
                        </div>
                            @else
                        <button type="button" class="btn btn-primary rounded products" data-toggle="modal" data-target="#prod{{$item->codice_prodotto}}" value="{{$item->codice_prodotto}}">
                            <i class="fas fa-truck"></i>
                        </button>
                        @endif
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
                    </form>
                </div>
            </div>
        </div>
        @endforeach
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


@include('layouts.handlebars_layout.orderEcommerceHandle')
@endsection