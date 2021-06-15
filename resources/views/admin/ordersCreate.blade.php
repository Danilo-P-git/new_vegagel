@extends('layouts.side')

@section('content')
{{-- @dd(session()->get('cart')) --}}
<div class="container bg-light shadow p-5 rounded">


    <div class="overflow-auto p-2">
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        @if (Session::has('cart'))
            
        
        @php $cart = session()->get('cart')
        @endphp

        
        <h2>Ordine in creazione</h2>
        <div class="overflow-auto p-2" style="width: 50%">
            <table class="table border shadow table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome prodotto</th>
                        <th>Codice prodotto</th>
                        <th>Quantita</th>
                        <th>Lotto</th>

                    </tr>
                    
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                    <tr>
                        <td>{{$item['nome']}}</td>
                        <td>{{$item['codice_prodotto']}}</td>
                        <td>{{$item['quantita']}}</td>
                        <td>{{$item['lotto']}}</td>
                    </tr>
                    @endforeach   
                </tbody>
            </table>
            
        </div>
        <form action="{{route('admin.orderSend')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
        <label for="data_di_consegna">data_di_consegna</label>
        <input name="data_di_consegna" type="date" id="data_di_consegna" class="form-control" style="width: 25%" required value="" >
        <button type="submit" class="btn btn-primary">Invia ordine</button>
        </form>
        @endif
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
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary products" data-toggle="modal" data-target="#prod{{$item->codice_prodotto}}" value="{{$item->codice_prodotto}}">
                              Launch
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="prod{{$item->codice_prodotto}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Elementi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body element-wrapper">
                                            sada
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
@include('layouts.handlebars_layout.orderHandle')


@endsection
