@extends('layouts.app')

@section('content')


<div class="container d-flex flex-wrap">
    <div>
        <a href="{{route("worker.create")}}" class="btn btn-success"> Scarico merci</a>
    </div>
    <div>
    </div>

    <table class="table table-dark table-hover">

        <thead>
            <th scope="col">@sortablelink('sector.settore', 'Settore')</th>
            <th scope="col">@sortablelink('codice_prodotto', 'Codice Prodotto')</th>
            <th scope="col">@sortablelink('name', 'Nome Prodotto')</th>
            <th scope="col">@sortablelink('created_at', 'Arrivato il')</th>
            <th scope="col">@sortablelink('updated_at', 'Spostato il')</th>
            <th scope="col">@sortablelink('data_di_scadenza', 'data di scadenza')</th>
            <th scope="col">Azioni</th>


        </thead>

        <tbody>
            @if($products->count()==0)
                <tr>
                    <td colspan="5"> Nessun prodotto in database</td>
                </tr>
            @endif

            @foreach ($products as $product)
                <tr>
                    <td>{{$product->sector->settore}}</td>
                    <td>{{$product->codice_prodotto}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->created_at}}</td>
                    <td>{{$product->updated_at}}</td>
                    <td>{{$product->data_di_scadenza}}</td>
                    <td>
                        <a href="{{route("worker.edit", $product->id)}}" class="btn btn-primary rounded"><i class="fas fa-edit"></i></a>

                        <a href="{{route("worker.show", $product->id)}}" class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
