@extends('ecommerce.side')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">Risultati di ricerca</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <button class="btn btn-danger"><a href="{{route('welcome')}}" style="text-decoration: none">Torna Indietro</a></button>
                </div>
            </div>
        </div>
        <div class="container shadow mt-5 my-5">
            <div class="row justify-content-center">
                @foreach ($filtered as $filter)
                <div class="col-12 col-md-3 m-5 ">
                    <div class="card card-round">
                        {{-- <img src="{{asset('storage/'.$filter->photo)}}" class="card-img-top img-fluid mt-3 my-3" style="height:300px;object-fit: contain" alt="..."> --}}
                        <img src="https://via.placeholder.com/728.png?text=Immagine+segnaposto" class="card-img-top img-fluid mt-3 my-3" style="height:300px;object-fit: contain" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Nome articolo: </h5>
                          <p style="color: #fd0000af"><strong>{{$filter->name}}</p></strong>
                          <h5 class="card-text">Descrizione prodotto: </h5>
                          <p style="color: #fd0000af"><strong>{{$filter->description}}</p></strong><hr>
                          <h5 class="card-text">Prezzo singolo: <strong><span style="color: #fd0000af">{{$filter->prezzo_al_pezzo}} €</span></strong></h5>
                          <h5 class="card-text">Prezzo al Kg: <strong><span style="color: #fd0000af">{{$filter->prezzo_al_kg}} €</span></strong></h5>
                          <h5 class="card-text">Unità disponibili: <strong><span style="color: #fd0000af">{{$filter->sector->quantita_rimanente - $filter->sector->quantita_bloccata}}</span></strong></h5>
                          
                          <a href="#" class="btn btn-primary">Aggiungi al carrello</a>
                        </div>
                      </div>
                </div>
                @endforeach
            </div>
        </div>

        
    

{{--     <script>
        $(document).ready(function(){
        
            filter_data();
        
            function filter_data()
            {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var brand = get_filter('brand');
                var ram = get_filter('ram');
                var storage = get_filter('storage');
                $.ajax({
                    url:"fetch_data.php",
                    method:"POST",
                    data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
                    success:function(data){
                        $('.filter_data').html(data);
                    }
                });
            }
        
            function get_filter(class_name)
            {
                var filter = [];
                $('.'+class_name+':checked').each(function(){
                    filter.push($(this).val());
                });
                return filter;
            }
        
            $('.common_selector').click(function(){
                filter_data();
            });
        
            $('#price_range').slider({
                range:true,
                min:1000,
                max:65000,
                values:[1000, 65000],
                step:500,
                stop:function(event, ui)
                {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    filter_data();
                }
            });
        
        });
        </script> --}}
        @endsection