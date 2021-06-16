@extends('layouts.app')

@section('content')

<div class="container shadow bg-light p-5 rounded d-flex flex-column">
    <div class="alert alert-warning text-center" role="alert">
        <strong>Attenzione</strong> si ricorda di scannerizzare tutti i prodotti prima di completare l'ordine, si rischia di creare disguidi e malfunzionamenti futuri in caso contrario!!
      </div>
    <h1 class="text-center">ORDINI DA SMISTARE</h1>
    @foreach ($orders as $order)
    @if ($order->user->ragione_sociale != null)
        @php
            $nome = $order->user->ragione_sociale
        @endphp
    @else
        @php
            $nome = $order->user->name;
        @endphp
    @endif
        <div class="card mt-4 mx-auto" style="width: 70%">
            <div class="card-body">
            <a href="{{route('worker.orderShow', $order->id)}}">

                <h2 class="card-title text-center">Ordine da {{$nome}}</h2>
                <p class="card-text"> Da consegnare entro  <strong>{{$order->data_di_consegna}} </strong></p>
                

            </a>

            </div>
            <div class="card-footer text-muted">
                <form action="{{route('worker.orderDone', $order->id)}}">
                    <div class="custom-control custom-switch">
                        <input name="check{{$order->id}}" type="checkbox" class="custom-control-input" id="check{{$order->id}}">
                        <label class="custom-control-label" for="check{{$order->id}}">Ordine completato ? </label>
                      
                    </div>
                    
                </form>
                <script>
                    $('#check{{$order->id}}').on('change', function(){
                        if (confirm('Sicuro di completare l ordine')) {
                            $(this).closest('form').submit()
                            
                        }
                    })
                </script>
            </div>
        </div>
    
    @endforeach

</div>

@endsection
