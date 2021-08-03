
@extends('layouts.app')

@section('content')
<script>
          (function ($) {
        $.fn.codeScanner = function (options) {
            var settings = $.extend({}, $.fn.codeScanner.defaults, options);
    
            return this.each(function () {
                var pressed = false;
                var chars = [];
                var $input = $(this);
    
                $(window).keypress(function (e) {
                    var keycode = (e.which) ? e.which : e.keyCode;
                    if ((keycode >= 65 && keycode <= 90) ||
                        (keycode >= 97 && keycode <= 122) ||
                        (keycode >= 45 && keycode <= 57) // modifica dei caratteri presi dalla funzione codeScanner
                    ) {
                        chars.push(String.fromCharCode(e.which));
                    }
                    // console.log(e.which + ":" + chars.join("|"));
                    if (pressed == false) {
                        setTimeout(function () {
                            if (chars.length >= settings.minEntryChars) {
                                var barcode = chars.join('');
                                settings.onScan($input, barcode);
                            }
                            chars = [];
                            pressed = false;
                        }, settings.maxEntryTime);
                    }
                    pressed = true;
                });
    
                // $(this).keypress(function (e) {
                //     if (e.which === 13) {
                //         e.preventDefault();
                //     }
                // });
    
                return $(this);
            });
        };
    
        $.fn.codeScanner.defaults = {
            minEntryChars: 8,
            maxEntryTime: 100,
            onScan: function ($element, barcode) {
                $element.val(barcode);
            }
        };
    })(jQuery);
</script>

<div class="container d-flex ">
    <a class="btn btn-primary" href="{{route("worker.orders")}}">Torna alla pagina degli ordini</a>

</div>
<div class="container d-flex shadow bg-light p-1 px-md-5 rounded justify-content-center flex-wrap">

@foreach ($pivot as $value => $key)

@php
    $quantitaOrdinata = $key->quantita;
    $quantitaACartone = $products[$value]->sector->quantita_a_cartone;
    if (is_Int($quantitaOrdinata/$quantitaACartone)) {
       $collo = $quantitaOrdinata/$quantitaACartone;
       $verifica = true;
    } else {
        $verifca = false;
    }
@endphp
    <div class="card m-2 orders-card p-4" style=" @if ($key->completato == 1) background-color: rgba(25, 255, 0, 0.34); @endif" id="{{$products[$value]->id}}">
        <div class="card-body position-relative">
            <h5 class="card-title">Prodotto {{$products[$value]->codice_prodotto}}</h5>
            <p class="card-text"> Settore più vicino {{$products[$value]->sector->settore}}</p>
            <p class="card-text"> Quantita ordinata {{$key->quantita}}</p>
            @if ($verifca = true)
                
            <p class="card-text">Colli ordinati{{$collo}}</p>
            @endif

           <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" id="test{{$key->id}}" data-target="#modal{{$key->id}}">
                Carica
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="modal{{$key->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prodotto {{$products[$value]->codice_prodotto}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('worker.orderConfirm', $key->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                      
                                <label for="codice_readonly">Codice prodotto</label>
                                <input name="codice_readonly" type="text"  class="form-control" id="read{{$key->id}}" value="{{$products[$value]->codice_prodotto}}" readonly>
                            </div>

                            <div class="form-group">
                                      
                                <label for="codice_prodotto">Scansiona il codice prodotto singolo</label>
                                <input name="codice_prodotto" type="text" id="prod{{$key->id}}"  class="form-control" value="" >

                                <input hidden name="quantita" type="text" value="{{$key->quantita}}">
                            </div>
                            
                            <script>
                                $('#test{{$key->id}}').on('click', function () {
                                    $('.conf').attr('disabled', true);


                                }); 
                                $('#prod{{$key->id}}').codeScanner({
                                    maxEntryTime: 100, // milliseconds
                                    minEntryChars: 7  // characters
                                });
                                $('#prod{{$key->id}}').codeScanner({
                                onScan: function ($element, code) {
                                    var test =  $('#prod{{$key->id}}').val(code);
                                        if (test != $('#read{{$key->id}}').val()) {
                                            $('#prod{{$key->id}}').addClass('is-invalid');
                                            $('.conf').attr('disabled', true);

                                        } else {
                                            $('#prod{{$key->id}}').removeClass('is-invalid');

                                            $('#prod{{$key->id}}').addClass('is-valid');
                                            $('.conf').attr('disabled', false);

                                        }
                                    }
                                });
                                $('#prod{{$key->id}}').on('change', function(){
                                    var test =  $('#prod{{$key->id}}').val();

                                    if (test == $('#read{{$key->id}}').val()) {
                                        $('#prod{{$key->id}}').removeClass('is-invalid');

                                        $('#prod{{$key->id}}').addClass('is-valid');
                                        $('.conf').attr('disabled', false);
                                        
                                    } else {
                                        $('#prod{{$key->id}}').addClass('is-invalid');
                                        $('.conf').attr('disabled', true);
                                    }
                                });
                                

                            </script>
                            <button type="submit" class="btn btn-primary conf">Conferma</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    </div>
                </div>
                </div>
            </div>
            @if ($key->completato == 1)

            <div class="position-absolute" style="color:green; font-size: 20px; left:0; top: 10px;"><i class="fas fa-check"></i></div>
                
            @endif
        </div>
    </div>

  @endforeach
</div>

@endsection