@extends('layouts.side')

@section('content')
<div class="container">

    <div class="table-container" role="table" aria-label="Destinations">
        <div class="flex-table header" role="rowgroup">
            <div class="flex-row first" role="columnheader">Nome</div>
            <div class="flex-row" role="columnheader">Azione</div>
            <div class="flex-row" role="columnheader">Codice a 23 cifre scannerizzato</div>
            <div class="flex-row" role="columnheader">Orario</div>
        </div>
        @foreach ($log as $item )
            <div class="flex-table row" role="rowgroup">
                <div class="flex-row first" role="cell"><span class="flag-icon flag-icon-gb"></span> {{$item->nome}}</div>
                <div class="flex-row" role="cell">{{$item->azione}} </div>
                <div class="flex-row" role="cell">{{$item->codice_movimento}}</div>
                <div class="flex-row" role="cell">{{$item->created_at}}</div>
            </div>
        @endforeach

    </div>

    {{-- <table class="table border shadow table-bordered table-hover" >
        <thead class="thead-dark">
            <tr>
                <th scope="col">@sortablelink('nome', 'Nome')</th>
                <th scope="col">@sortablelink('cognome', 'Cognome')</th>
                <th scope="col">@sortablelink('azione', 'Azione')</th>
                <th scope="col">@sortablelink('codice_movimento', 'Codice a 23 cifre scannerizzato')</th>
                <th scope="col">@sortablelink('created_at', 'Orario')</th>
            </tr>

        </thead>

        <tbody>
            @foreach ($log as $item )
                <tr>
                    <td>{{$item->nome}}</td>
                    <td>{{$item->cognome}}</td>
                    <td>{{$item->azione}}</td>
                    <td>{{$item->codice_movimento}}</td>
                    <td>{{$item->created_at}}</td>

                </tr>
            @endforeach
        </tbody>

    </table>
    {!! $log->appends(Request::except('page'))->render() !!}
    <p>
        Displaying {{$log->count()}} of {{ $log->total() }} log(s).
    </p> --}}
    
</div>
@endsection