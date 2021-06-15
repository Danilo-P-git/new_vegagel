@extends('layouts.side')

@section('content')
<div class="container bg-light shadow p-5 rounded">

    <a href="{{route('admin.ordersCreate')}}" class="btn btn-primary">crea un nuovo ordine</a>

    <div class="overflow-auto p-2">
        <table class="table border shadow table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>N° Ordine</th>
                    <th>Utente</th>
                    <th>Creato il</th>
                    <th>Stato</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
               
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->user_id}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>In lavorazione</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


@endsection