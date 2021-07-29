<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js" integrity="sha512-bCsBoYoW6zE0aja5xcIyoCDPfT27+cGr7AOCqelttLVRGay6EKGQbR6wm6SUcUGOMGXJpj+jrIpMS6i80+kZPw==" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    NEW VEGAGEL
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        @auth


                        @php
                            
                            $user = Auth::user()->is_worker;
                            $admin = Auth::user()->is_admin;
                        @endphp
                        @if ($user == 1 || $admin == 1)
                        <li class="nav-item">

                            <a class="nav-link" href="{{route('worker.home')}}">Zona Worker</a>
                        </li>
                        
                        @endif

                        @php $admin = Auth::user()->is_admin;
                        @endphp
                        @if ($admin==1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.home')}}">Admin dashboard</a>

                        </li>

                        @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container shadow mt-5 my-5">
            <div class="row justify-content-center">
                @foreach ($products as $product)
                <div class="col-12 col-md-3 m-5 rounded-3">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body shadow">
                          <h5 class="card-title">Nome articolo: </h5>
                          <p style="color: #fd0000af"><strong>{{$product->name}}</p></strong>
                          <h5 class="card-text">Descrizione prodotto: </h5>
                          <p style="color: #fd0000af"><strong>{{$product->description}}</p></strong><hr>
                          <h5 class="card-text">Prezzo singolo: <strong><span style="color: #fd0000af">{{$product->prezzo_al_pezzo}} €</span></strong></h5>
                          <h5 class="card-text">Prezzo al Kg: <strong><span style="color: #fd0000af">{{$product->prezzo_al_kg}} €</span></strong></h5>
                          <h5 class="card-text">Unità disponibili: <strong><span style="color: #fd0000af">{{$product->sector->quantita_rimanente - $product->sector->quantita_bloccata}}</span></strong></h5>
                          
                          <a href="#" class="btn btn-primary">Aggiungi al carrello</a>
                        </div>
                      </div>
                </div>
                @endforeach
            </div>
        </div>

        <main class="py-4 bg-grey-100 app-layout">
            @yield('content')
        </main>
    </div>

    

    <script>




    </script>
</body>
</html>
