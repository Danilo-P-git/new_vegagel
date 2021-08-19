@extends('layouts.side')

@section('content')
<div class="container-sm bg-light shadow p-1 px-lg-5 rounded">
    {{-- <div class="text-center">
        <a href="{{route('ecommerce.ordersCreate')}}" class="btn btn-primary">Crea un nuovo Ordine</a>
    </div> --}}
    <div class="text-center">
        <h2>Storico Ordini E-commerce</h2>
    </div>
    <div class="overflow-auto p-2">
        <table class="table border shadow table-bordered table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>N° Ordine</th>
                    <th>Utente</th>
                    <th>Creato il</th>
                    <th>Stato</th>
                    <th>Azione</th>
                </tr>
            </thead>
            <tbody>
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
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$nome}}</td>
                        <td>{{$order->created_at}}</td>
                        
                        <td>@if ($order->annullato == 0)
                            @if ($order->completato == 1)
                            Completato
                            @else
                            In lavorazione
                            
                        @endif
                        @else
                            Ordine Cancellato
                        @endif
                        
                        <a target="_blank" class="btn btn-primary" href="{{route('pdf.bollaEcommerce', $order->id)}}">Salva pdf</a>
                        </td>
                        <td>@if ($order->annullato == 1)
                            @if ($order->completato == 1)
                            @else 
                            <a href="{{route('ecommerce.deleteOrder', $order->id)}}"></a>
                            @endif
                        @else
                        @if ($order->completato == 1)
                        @else 
                        <a href="{{route('ecommerce.deleteOrder', $order->id)}}">Cancella</a>
                        @endif
                        @endif
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


@endsection