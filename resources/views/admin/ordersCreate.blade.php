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
