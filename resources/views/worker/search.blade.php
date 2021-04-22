@extends('layouts.app')

@section('content')

<div class="container">
    @if ($products->count())
    <table>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">@sortablelink('sector.settore', 'Settore')</th>
                <th scope="col">@sortablelink('sector.scaffale', 'scaffale')</th>
                <th scope="col">@sortablelink('codice_prodotto', 'Codice Prodotto')</th>
                <th scope="col">@sortablelink('codice_stock', 'Codice stock')</th>

                <th scope="col">@sortablelink('name', 'Nome Prodotto')</th>
                <th scope="col">@sortablelink('created_at', 'Arrivato il')</th>
                <th scope="col">@sortablelink('updated_at', 'Spostato il')</th>
                <th scope="col">@sortablelink('data_di_scadenza', 'data di scadenza')</th>
                <th scope="col">Azioni</th>

              </tr>
            </thead>
            <tbody>
              
                  @foreach ($products as $product)
                  <tr>
                    <td>{{$product->sector->settore}}</td>
                    <td>{{$product->sector->scaffale}}</td>
                    <td>{{$product->codice_prodotto}}</td>
                    <td>{{$product->codice_stock}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->created_at}}</td>
                    <td>{{$product->updated_at}}</td>
                    <td>{{$product->data_di_scadenza}}</td>
                    <td>
                        <a href="{{route("worker.edit", $product->id)}}" class="btn btn-primary rounded"><i class="fas fa-edit"></i></a>

                        <a href="{{route("worker.show", $product->id)}}" class="btn btn-secondary mt-1"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                  @endforeach

              
             
            </tbody>
          </table>
          
    </table>

    @endif
</div>

@endsection