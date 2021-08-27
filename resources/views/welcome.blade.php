@extends('ecommerce.side')

@section('content')

@if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        @if (Session::has('cart'))
            
        
        @php 
        
        $cart = session()->get('cart');

        
        @endphp

@endif
<div class="container">
    <div class="row">
        
           <a href="{{route('ecommerce.cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrello <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span></a>
        
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
                        <p><input type="number" name="quantity" value="" class="form-control quantity update-cart">inserisci quantita</p>
                            
                        @else
                        <h5 class="card-text">Unità disponibili: <strong><span style="color: #fd0000af">Esaurito!</span></strong></h5>

                        @endif
                        <input name="codice_stock" value="{{$item->codice_prodotto}} "hidden>                 
                        <!-- Button trigger modal -->
                       {{--  @if (Auth::User() == false )
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
                        @endif --}}
                        

                        <p class="btn-holder"><a href="{{ route('add.to.cart', $item->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
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