@extends('layouts.app')

@section('content')


<div id="scan-container" class="container d-flex flex-wrap flex-column">
    <h2 class="mx-auto my-5">
        Cerca il tuo prodotto
    </h2>

    <div class="d-flex mx-auto my-3">

        <form action="/worker/search" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input id="search" type="text" class="form-control" name="q"
                    placeholder="Cerca per codice prodotto"> <span class="input-group-btn">
                    <button id="submit" type="submit" class="btn btn-default">
                        <span class="">Cerca</span>
                    </button>
                </span>
            </div>
        </form>
    </div>
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


$('#scan-container').codeScanner({
    maxEntryTime: 100, // milliseconds
    minEntryChars: 7  // characters
  });

  $('#scan-container').codeScanner({
    onScan: function ($element, code) {
        $('#search').val(code);
        $('#submit').click();        
    }
    })
</script>
@endsection