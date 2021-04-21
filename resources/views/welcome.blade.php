@extends('layouts.app')

@section('content')

<div class="manutenzione">
    <div class="manutenzione-inside m-auto">
        <h1>Ci dispiace per l'incoveniente...</h1>
        <p class="inside-paragraph">In questo momento la pagina è in fase di manutenzione vi preghiamo di riprovare più tardi</p>
    </div>
</div>

{{-- Pagina reale  --}}


{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-2 col_home"> --}}
            {{-- aside foreach con le categorie da mettere al db  --}}
            {{-- <div class="aside-content">
                <h2 class="pl-4">
                    Categorie
                </h2>
                <ul>
                    <li class="pt-3"> <p>categoria 1</p> </li>
                    
                    <li class="pt-3"> <p>categoria 2</p> </li>
                    <li class="pt-3"> <p>categoria 3</p> </li>
                    
                    <li class="pt-3"> <p>categoria 4</p> </li>
                    

                    <li class="pt-3"> <p>categoria 5</p> </li>
                    

                    <li class="pt-3"> <p>categoria 6</p> </li>
                    


                </ul>
            </div> --}}
            {{-- aside foreach con le categorie da mettere al db  --}}
            
        {{-- </div>
        <div class="col-10">
            <div class="container d-flex flex-wrap">

                
                @foreach ($products as $product)
                <div class="card my-2 mx-2" style="width: 18rem;">
                    <img src="https://www.webfx.com/blog/images/cdn.designinstruct.com/files/582-how-to-image-placeholders/generic-image-placeholder.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <p class="card-text">{{$product->description}}</p>
                    <p class="card-text">{{$product->costo}}</p>
                    <a href="#" class="btn btn-primary">Aggiungi al carrello</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div> --}}

{{-- Pagina reale  --}}

@endsection