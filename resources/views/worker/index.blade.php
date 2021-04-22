@extends('layouts.app')

@section('content')


<div class="container d-flex flex-wrap flex-column">
    <h2 class="mx-auto my-5">
        Cerca il tuo prodotto
    </h2>

    <div class="d-flex mx-auto my-3">

        <form action="/worker/search" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="q"
                    placeholder="Cerca per codice prodotto"> <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="">Cerca</span>
                    </button>
                </span>
            </div>
        </form>
    </div>

@endsection