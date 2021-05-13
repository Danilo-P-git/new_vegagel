@extends('layouts.side')

@section('content')

<div class="container bg-light shadow p-5 rounded">


    <div class="overflow-auto p-2">

    
        <table class="table border shadow table-bordered table-hover" >
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
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>


@endsection