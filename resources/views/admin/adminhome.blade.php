@extends('layouts.side')

@section('content')
<div class="container-sm  bg-light shadow p-1 px-lg-5 rounded">

<form action="{{route('admin.selected')}}" method="POST">
    <select name="logUser" id="logUser">
        @foreach ($log->unique('nome') as $item)
        <option name="logUser" value="{{$item->nome}}">{{$item->nome}}</option>
        @endforeach
    </select>
    <button class="btn bnt-danger" type="submit"> Conferma Scelta</button>
</form>

    <div class="overflow-auto p-2">

    
        <table class="table border shadow table-bordered table-hover" >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">@sortablelink('nome', 'Nome')</th>
                    <th scope="col">@sortablelink('azione', 'Azione')</th>
                    <th scope="col">@sortablelink('codice_movimento', 'Codice a 23 cifre scannerizzato')</th>
                    <th scope="col">@sortablelink('created_at', 'Orario')</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($log as $item )
                    <tr>
                        <td>{{$item->nome}}</td>
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
        </p>
    </div>
</div>
@endsection