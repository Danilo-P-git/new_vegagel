@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{-- @dd($message); --}}

                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        {{-- @dd($message); --}}

                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth">

                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        @dd($message);
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        {{-- @dd($message); --}}

                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        {{-- AZIENDE  --}}
                        <a id="show"  class="btn btn-outline-primary">Sei un azienda?</a>

                        {{-- <div  id="show-hide" style="display: none"> --}}


                            <div class="form-group row">
                                <label for="pec" class="col-md-4 col-form-label text-md-right">{{ __('PEC registrata') }}</label>
    
                                <div class="col-md-6">
                                    <input id="pec" type="email" class="pers-required form-control @error('pec') is-invalid @enderror" name="pec" value="{{ old('pec') }}"  >
    
                                    @error('pec')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Numero di telefono') }}</label>
    
                                <div class="col-md-6">
                                    <input id="telefono" type="text" class="pers-required form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}"  >
    
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="indirizzo" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo completo') }}</label>
    
                                <div class="col-md-6">
                                    <input id="indirizzo" type="text" class="pers-required form-control @error('indirizzo') is-invalid @enderror" name="indirizzo" value="{{ old('indirizzo') }}"  >
    
                                    @error('indirizzo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="codice_fiscale" class="col-md-4 col-form-label text-md-right">{{ __('Codice fiscale') }}</label>
    
                                <div class="col-md-6">
                                    <input id="codice_fiscale" type="text" class=" pers-required form-control @error('codice_fiscale') is-invalid @enderror" name="codice_fiscale" value="{{ old('codice_fiscale') }}" >
    
                                    @error('codice_fiscale')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="citta" class="col-md-4 col-form-label text-md-right">{{ __('Città') }}</label>
    
                                <div class="col-md-6">
                                    <input id="citta" type="text" class=" pers-required form-control @error('citta') is-invalid @enderror" name="citta"  value="{{ old('citta') }}" >
    
                                    @error('citta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cap" class="col-md-4 col-form-label text-md-right">{{ __('CAP') }}</label>
    
                                <div class="col-md-6">
                                    <input id="cap" type="number" class="pers-required form-control @error('cap') is-invalid @enderror" name="cap" value="{{ old('cap') }}" >
    
                                    @error('cap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comune" class="col-md-4 col-form-label text-md-right">{{ __('Comune') }}</label>
    
                                <div class="col-md-6">
                                    <input id="comune" type="text" class="pers-required form-control @error('comune') is-invalid @enderror" name="comune" value="{{ old('comune') }}" >
    
                                    @error('comune')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="provincia" class="col-md-4 col-form-label text-md-right">{{ __('Provincia') }}</label>
    
                                <div class="col-md-6">
                                    <input id="provincia" type="text" class="pers-required form-control @error('provincia') is-invalid @enderror" name="provincia" value="{{ old('provincia') }}" >
    
                                    @error('provincia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="partita_iva" class="col-md-4 col-form-label text-md-right">{{ __('Partita iva') }}</label>
    
                                <div class="col-md-6">
                                    <input id="partita_iva" type="text" class="pers-required form-control @error('partita_iva') is-invalid @enderror" name="partita_iva" value="{{ old('partita_iva') }}" >
    
                                    @error('partita_iva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ragione_sociale" class="col-md-4 col-form-label text-md-right">{{ __('Ragione sociale') }}</label>
    
                                <div class="col-md-6">
                                    <input id="ragione_sociale" type="text" class="pers-required form-control @error('ragione_sociale') is-invalid @enderror" name="ragione_sociale" value="{{ old('ragione_sociale') }}" >
    
                                    @error('ragione_sociale')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                        {{-- </div> --}}

                        {{-- AZIENDE  --}}


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$('#show').on('click', function () {

    $('#show-hide').toggle('slow');
    var required =  $('.pers-required'); 
    if (required.attr('required')) {
        required.removeAttr('required');
    } else {
        required.prop('required', true);
    }
  })

</script>
@endsection
