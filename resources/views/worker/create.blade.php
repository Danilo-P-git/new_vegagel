@extends('layouts.app')

@section('content')


<div id="scan-container" class="container">


    
    <form action="{{route('worker.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('POST')


      <div class="card">
        
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
      
      </div>
    
      {{-- form row  --}}

  <div class="form-row">
    <div class="form-group col-md-5 col-4">
      
      <label for="codice_prodotto">codice prodotto</label>
      <input name="codice_prodotto" type="number" id="codice_prodotto" class="form-control code-scanner" value="">
      @error('codice_prodotto')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-5 col-4">
      <label for="codice_stock">codice stock</label>
      <input name="codice_stock" type="number" id="codice_stock" class="form-control code-scanner" value="">
      @error('codice_stock')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-2 col-4">
      
      <label for="lotto">Lotto</label>
      <input name="lotto" type="number" id="lotto" class="form-control code-scanner" value="">
      @error('lotto')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    
    
  </div>

      {{-- form row  --}}

  <div class="form-row">

    <div class="form-group col-md-4 col-4">
      <label for="scaffale">scaffale</label>
      <input name="scaffale" type="text"  id="scaffale" class="form-control" value="">
      @error('scaffale')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="form-group col-md-4 col-4">
      <label for="quantita_rimanente">Quantità totale</label>
      <input name="quantita_rimanente" type="number"  id="quantita_rimanente" class="form-control" value=""> 
      @error('quantita_rimanente')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-4 col-4">
      <label for="data_di_scadenza">data_di_scadenza</label>
      <input name="data_di_scadenza" type="date" id="data_di_scadenza" class="form-control" value="" >
      @error('data_di_scadenza')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
      {{-- form row  --}}

      {{-- form row  --}}

  <div class="form-row">

    <div class="form-group col-md-4 col-4">
      <label for="name">name</label>
      <input name="name" type="text" class="form-control" id="name" value="">
      @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-4 col-4">
      <label for="description">description</label>
      <input name="description" type="text" class="form-control" id="description" value="">
      @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group col-md-4 col-4">
      
      <label for="quantita_al_cartone">Quantità al cartone</label>
      <input name="quantita_al_cartone" type="number" id="quantita_al_cartone" class="form-control code-scanner" value="">
      @error('quantita_al_cartone')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>

    {{-- form row  --}}


    {{-- form row  --}}

  <div class="form-row">
    <div class="form-group col-md-4 col-4">
      
      <label for="prezzo_al_pezzo">Prezzo al pezzo</label>
      <input name="prezzo_al_pezzo" type="number" id="prezzo_al_pezzo" class="form-control code-scanner" value="">
      @error('prezzo_al_pezzo')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-4 col-4">
      <label for="prezzo_al_kg">Prezzo al kg</label>
      <input name="prezzo_al_kg" type="number" step=0.01 class="form-control" id="prezzo_al_kg" value="">
      @error('prezzo_al_kg')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    
    <div class="form-group col-md-4 col-4">
      <label for="settore">settore</label>
      <input name="settore" type="text" class="form-control" id="settore" value="">
      @error('settore')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
    {{-- form row  --}}


  <button type="submit" class="btn btn-primary">Scarica</button>
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
            var $input = $(this);

            $(window).keypress(function (e) {
                var keycode = (e.which) ? e.which : e.keyCode;
                if ((keycode >= 65 && keycode <= 90) ||
                    (keycode >= 97 && keycode <= 122) ||
                    (keycode >= 48 && keycode <= 57)
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
        var data_di_scadenza = code.substring(0, 5)
        $('#data_di_scadenza').val(data_di_scadenza);
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


 </script>
@endsection