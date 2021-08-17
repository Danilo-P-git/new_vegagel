@extends('layouts.app')

@section('content')


<div class="container shadow bg-light p-1 px-md-5 rounded">
  
    <div class="row py-1 py-md-3">
      <div class="col-6">
          <a class="btn  btn_menu shadow  m-auto d-flex" href="{{route("worker.create")}}"><span class="m-auto">Scarico merci</span></a>

      </div>
      <div class="col-6">
        <a class="btn  btn_menu shadow m-auto d-flex" href="{{route("worker.spostamento")}}"><span class="m-auto">Spostamento merci</span></a>
          

      </div>
      <div class="w-100 py-3"></div>
      <div class="col-6">
          
        <a class="btn  btn_menu shadow m-auto d-flex" href="{{route("worker.orders")}}"><span class="m-auto">Ordini</span></a>

      </div>
      <div class="col-6">
        <a class="btn  btn_menu shadow m-auto d-flex" href="{{route('worker.orderEcommerce')}}"><span class="m-auto">Ordini Ecommerce</span></a>
          

      </div>
    
  </div>

@endsection