@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-2 col_home">
            {{-- aside foreach con le categorie da mettere al db  --}}
            <div class="aside-content">
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
            </div>
            {{-- aside foreach con le categorie da mettere al db  --}}
            
        </div>
        <div class="col-10">
            
        </div>
    </div>

</div>
@endsection