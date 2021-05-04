@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
      <div class="col d-flex">
          <a class="btn  btn_menu shadow  m-auto d-flex" href="{{route("worker.create")}}"><span class="m-auto">Scarico merci</span></a>

      </div>
      <div class="col">
        <a class="btn  btn_menu shadow m-auto d-flex" href="{{route("worker.spostamento")}}"><span class="m-auto">Spostamento merci</span></a>
          

      </div>
      <div class="w-100 py-3"></div>
      <div class="col">
          
        <a class="btn  btn_menu shadow m-auto d-flex" href=""><span class="m-auto">WIP Ordini</span></a>

      </div>
      <div class="col">
        <a class="btn  btn_menu shadow m-auto d-flex" href=""><span class="m-auto">WIP Delivery</span></a>
          

      </div>
    </div>
  </div>

@endsection