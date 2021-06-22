@extends('layouts.side')

@section('content')
<div class="container-sm  bg-light shadow p-1 px-lg-5 rounded">

    <section id="scaduti">
        <h2>Prodotti scaduti</h2>
        <div class="text-right py-2">
        <a target="_blank" class="btn btn-primary" href="{{route('pdf.scaduti')}}">Scarica tabella scaduti</a>
        </div>
        <table class="table border shadow table-bordered table-hover rounded">
            <thead class="thead-dark rounded">
                <tr>
                    <th>@sortablelink('name','Nome prodotto')</th>
                    <th>@sortablelink('lotto','Lotto')</th>
                    <th>@sortablelink('data_di_scadenza', 'Data di scadenza')</th>
                    <th>Settore</th>
                    <th>Scaffale</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($scaduti as $item )
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->lotto}}</td>
                        <td>{{$item->data_di_scadenza}}</td>
                        <td>{{$item->sector->settore}}</td>
                        <td>{{$item->sector->scaffale}}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $scaduti->appends(Request::except('page'))->render() !!}
        <p>
            Mostra {{$scaduti->count()}} di {{ $scaduti->total() }} Prodotti scaduti.
        </p>
    
    </section>

    
    <section id="inScadenza">
        <h2>Prodotti in Scadenza</h2>
        <div class="text-right py-2">
            <a target="_blank" class="btn btn-primary" href="{{route('pdf.inScadenza')}}">Scarica tabella in scadenza</a>
        </div>
        <table class="table border shadow table-bordered table-hover rounded">
            <thead class="thead-dark rounded">
                <tr>
                    <th>@sortablelink('name','Nome prodotto')</th>
                    <th>@sortablelink('lotto','Lotto')</th>
                    <th>@sortablelink('data_di_scadenza', 'data_di_scadenza')</th>
                    <th>Settore</th>
                    <th>Scaffale</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($inScadenza as $item )
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->lotto}}</td>
                        <td>{{$item->data_di_scadenza}}</td>
                        <td>{{$item->sector->settore}}</td>
                        <td>{{$item->sector->scaffale}}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $inScadenza->appends(Request::except('page'))->render() !!}
        <p>
            Mostra {{$inScadenza->count()}} di {{ $inScadenza->total() }} Prodotti inScadenza.
        </p>
    
    </section>

    <section id="products">
        <h2>Prodotti</h2>
        <div class="text-right py-2">
            <a target="_blank" class="btn btn-primary" href="{{route('pdf.prodotti')}}">Scarica tabella prodotti</a>
        </div>
        <table class="table border shadow table-bordered table-hover rounded">
            <thead class="thead-dark rounded">
                <tr>
                    <th>@sortablelink('name','Nome prodotto')</th>
                    <th>@sortablelink('lotto','Lotto')</th>
                    <th>@sortablelink('data_di_scadenza', 'data_di_scadenza')</th>
                    <th>Settore</th>
                    <th>Scaffale</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($products as $item )
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->lotto}}</td>
                        <td>{{$item->data_di_scadenza}}</td>
                        <td>{{$item->sector->settore}}</td>
                        <td>{{$item->sector->scaffale}}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $products->appends(Request::except('page'))->render() !!}
        <p>
            Mostra {{$products->count()}} di {{ $products->total() }} Prodotti.
        </p>
    
    </section>



</div>

@endsection