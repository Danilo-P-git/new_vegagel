@extends('layouts.app')

@section('content')


<div id="scan-container" class="container shadow bg-light p-1 px-md-5 rounded">
  
  <div id="noFound" class=" fixed-top  alert alert-danger" role="alert" style="display: none">
    ERRORE, Il codice non è all&apos;interno del database si prega di contattare l&apos;amministratore a questa mail danilo.patane@kemedia.it si è pregati di aggiungere in allegato una foto nitida del codice a barre che ha generato il problema. <br>
    Nel frattempo si prega di mettere a mano il codice del prodotto il lotto e tutte le informazioni necessarie
  </div>


    <form action="{{route('worker.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('POST')


      {{-- <div class="card">

        <div class="card-body">

          <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6">

              <div id="interactive" class="viewport"></div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">

              <div id="result_strip">

              </div>

            </div>

          </div>

        </div>

      </div> --}}

      {{-- form row  --}}

  <div class="form-row">
    <div class="form-group col-md-5 col-12">

      <label for="codice_prodotto">codice prodotto</label>
      <input name="codice_prodotto" required type="text" id="codice_prodotto" class="form-control code-scanner" value="">
      @error('codice_prodotto')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-5 col-12">
      <label for="codice_stock">codice stock</label>
      <input name="codice_stock" required type="text" id="codice_stock" class="form-control code-scanner" value="">
      @error('codice_stock')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-2 col-12">

      <label for="lotto">Lotto</label>
      <input name="lotto" required type="text" id="lotto" class="form-control code-scanner" value="">
      @error('lotto')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>


  </div>

      {{-- form row  --}}

  <div class="form-row">

    <div class="form-group col-md-3 col-12">
      <label for="scaffale">scaffale</label>
      <input name="scaffale" required type="text"  id="scaffale" class="form-control" value="">
      @error('scaffale')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="form-group col-md-3 col-12">
      <label for="quantita_rimanente">Quantità totale</label>
      <input name="quantita_rimanente" required type="number"  id="quantita_rimanente" class="form-control" value="">
      @error('quantita_rimanente')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-3 col-12">
      <label for="data_di_scadenza">data_di_scadenza</label>
      <input name="data_di_scadenza" required type="date" id="data_di_scadenza" class="form-control" value="" >
      @error('data_di_scadenza')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-3 col-12">
      <label for="category_id">Categoria</label>
      <select class="custom-select custom-select-lg" name="category_id" id="category_id">
          @foreach ($categories as $category )
              <option value="{{$category->id}}" >{{$category->tipo}}</option>
          @endforeach
      </select>
    </div>
  </div>
      {{-- form row  --}}

      {{-- form row  --}}

  <div class="form-row">

    <div class="form-group col-md-4 col-12">
      <label for="name">name</label>
      <input name="name" required type="text" class="form-control" id="name" value="">
      @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-4 col-12">
      <label for="description">description</label>
      <input name="description" required type="text" class="form-control" id="description" value="">
      @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-4 col-12">

      <label for="quantita_di_cartoni">Numero di Cartoni</label>
      <input name="quantita_di_cartoni" required type="number" id="quantita_di_cartoni" class="form-control code-scanner" value="">
      @error('quantita_di_cartoni')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>

    {{-- form row  --}}


    {{-- form row  --}}

  <div class="form-row">
    <div class="form-group col-md-3 col-6">

      <label for="prezzo_al_pezzo">Prezzo al pezzo</label>
      <input name="prezzo_al_pezzo" required type="number"  step=0.01  id="prezzo_al_pezzo" class="form-control code-scanner" value="">
      @error('prezzo_al_pezzo')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-3 col-6">
      <label for="prezzo_al_kg">Prezzo al kg</label>
      <input name="prezzo_al_kg" required type="number" step=0.01 class="form-control" id="prezzo_al_kg" value="">
      @error('prezzo_al_kg')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="form-group col-md-3 col-6">
      <label for="settore">settore</label>
      <input name="settore" required type="text" class="form-control" id="settore" value="">
      @error('settore')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-3 col-6">

      <label for="peso">Peso pezzo singolo <strong>(Kg/l)</strong></label>
      <input name="peso" required type="text" class="form-control" id="peso" value="">
      @error('peso')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
    {{-- form row  --}}
    <div class="alert alert-warning my-2" role="alert">
      <i class="fas fa-exclamation-circle"></i>
      Si ricorda di compilare tutti i campi per poter andare avanti con l'inserimento
    </div>

    <input hidden name="quantita_a_cartone" type="number" id="quantita_a_cartone" value="" >
    {{-- <a id="test" class="btn btn-success"> TESTAMI</a> --}}
  <button id="submit" type="submit" class="btn btn-primary">Scarica</button>
  </form>

</div>

<script type="text/javascript">
  // code scanning function
  (function ($) {
    $.fn.codeScanner = function (options) {
        var settings = $.extend({}, $.fn.codeScanner.defaults, options);

        return this.each(function () {
            var pressed = false;
            var chars = [];
            var $input = $(this) ;

            $(window).keypress(function (e) {
                var keycode = (e.which) ? e.which : e.keyCode;

                if ((keycode >= 65 && keycode <= 90) ||
                    (keycode >= 97 && keycode <= 122) ||
                    (keycode >= 45 && keycode <= 58) // modifica dei caratteri presi dalla funzione codeScanner
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

            $(this).keypress(function (e) {
                if (e.which === 13) {
                    e.preventDefault();
                }
            });

            return $(this);
        });
    };

    $.fn.codeScanner.defaults = {
        minEntryChars: 8,
        maxEntryTime: 100,
        onScan: function ($element, barcode) {
          console.log(barcode);
            $element.val(barcode);
        }
    };
})(jQuery);


  // code scanning function


  // TAKING SCAN
   $('#scan-container').codeScanner({
    maxEntryTime: 100, // milliseconds
    minEntryChars: 7  // characters
    });
    $('#scan-container').codeScanner({
    onScan: function ($element, code) {
      console.log( code + "  " + "lunghezza" +  code.length);

       if (code.length > 24 && code.length < 28) {
      $('#codice_stock').val(code);

         console.log( code + "  " + "lunghezza" +  code.length);

         var frazione1 = code.substr(18, 7) ;
         console.log(frazione1);
         $('#lotto').val(frazione1);


       } else if (code.length > 34 && code.length < 40){
          $('#codice_stock').val(code);
          var lotto = code.substr(26, 9);
          console.log(lotto);
          $('#lotto').val(lotto);
          var data = code.substr(18, 6);
          var dataCorretta = "20" + data.substr(0, 2) + "-" + data.substr(2,2) + "-" + data.substr(4,2) ;
          console.log(dataCorretta);
          $("#data_di_scadenza").val(dataCorretta);
          var prodotto = code.substr(2, 14);
          console.log(prodotto);
          $("#codice_prodotto").val(prodotto);
       } else if (code.length > 39 && code.length < 46) {
        $('#codice_stock').val(code);

        //  inserimento lotto
          var lotto = code.substr(37, 5);
         console.log(lotto);
         $('#lotto').val(lotto);
        //  !inserimento lotto
        // inserimento peso
         var peso = code.substr(28, 6);
         console.log(peso);
         var pesoConDot = peso.substr(0,3) + '.' + peso.substr(3, peso.length) ;
         console.log(pesoConDot);

        // $('#peso').val(pesoConDot);
        // !inserimento peso
        // inserimento data
         var data = code.substr(18, 6);
         console.log(data);
         var dataCorretta =  "20" + data.substr(0, 2) + "-" + data.substr(2,2) + "-" + data.substr(4,2) ;
         console.log(dataCorretta);
          $('#data_di_scadenza').val(dataCorretta)
        // !inserimento data

       } else if (code.length > 13 && code.length < 16) {
        $('#codice_stock').val(code);
        var codice_prodotto = code.substr(1, (code.length -2 ));
        console.log(codice_prodotto);
        $('#codice_prodotto').val(codice_prodotto);
        //peso
        // var peso = codice_prodotto.substr(7, (codice_prodotto.length - 1) )
        // var pesoConDot = peso.substr(0,2) + '.' + peso.substr(2, peso.length) ;
        // $('#peso').val(pesoConDot);


       }else if (code.length > 7 && code.length <= 13 ){
        $('#codice_prodotto').val(code);
        // var lunghezzaPeso = code.length -1 ;
        // var peso = code.substr(7, 5 );
        // var pesoConDot = peso.substr(0,2) + '.' + peso.substr(2, peso.length) ;
        // $('#peso').val(pesoConDot);
       } else {
         $('#codice_stock').val(code);
         $('#noFound').show('fast');
         setTimeout(function(){
          $('#noFound').hide('fast');
         
         }, 8000);
        //  alert('ERRORE, Il codice non è all&apos;interno del database si prega di contattare l&apos;amministratore a questa mail danilo.patane@kemedia.it si è pregati di aggiungere in allegato una foto nitida del codice a barre che ha generato il problema. \n  Nel frattempo si prega di mettere a mano il codice del prodotto il lotto e tutte le informazioni necessarie')
       }

      var ajaxProdotto = $('#codice_prodotto').val();
      var protocol = window.location.protocol;
      var url = window.location.host;
      var webSite = protocol + '//' + url;

     if (ajaxProdotto != "") {

      $.ajax({

        "url": webSite + "/api/admin/cercaDuplicato",
        "data": {
            "codice_prodotto": ajaxProdotto
        },
        "method": "GET",
        "success": function (response) {
          console.log(response);
          $('#name').val(response.name);
          $('#prezzo_al_pezzo').val(response.prezzo_al_pezzo);
          $('#prezzo_al_kg').val(response.prezzo_al_kg);
          $('#description').val(response.description);
          $('#peso').val(response.peso);
          $('#category_id').val(response.category_id)




        },

      });
     }

    }
});


  // TAKING SCAN

  // PREVENT SENT FROM CODE SCANNING
  $("form").keydown(function (e) {
       if (e.keyCode == 13) {
           e.preventDefault();
           return false;
       }
   });



  // PREVENT SENT FROM CODE SCANNING

   $("#submit").on('click', function () {
     var quantitaDiCartoni = $("#quantita_di_cartoni").val();
     var quantitaTotale = $("#quantita_rimanente").val();
     var quantitaCartone = quantitaTotale / quantitaDiCartoni;
     $("#quantita_a_cartone").val(quantitaCartone);
   });




 </script>
@endsection
