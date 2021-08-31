<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
{{--     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 --}}    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js" integrity="sha512-bCsBoYoW6zE0aja5xcIyoCDPfT27+cGr7AOCqelttLVRGay6EKGQbR6wm6SUcUGOMGXJpj+jrIpMS6i80+kZPw==" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                  <img class="logo img-fluid" src="{{asset('storage/newvecagel.jpg')}}" alt="New Vecagel">
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
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('welcome') }}">E-Commerce</a>
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
        

        <main class="d-flex align-items-stretch ">
            <aside id="admin-nav">
                <div id="custom-menu">
                    <button type="button" id="sidebarCollapse" class="btn-custom">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                        </button>
                </div>
                <form action="{{route('welcome.filter')}}" method="GET">
                  @csrf
                  <div class="list-menu py-4 px-2">
                      <h1>Filtra Ricerca</h1>
                      <div id="accordion">
                          <div class="card">
                            <div class="card-header" id="headingOne">
                              <h5 class="mb-0">
                                <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  Filtra per prezzo <i class="fas fa-sort"></i>
                                </button>
                              </h5>
                            </div>
                            <label for="" class="mt-2 text-center" style="color: red">Prezzo Min:
                            <p><input type="text" class="form-control ml-5"  name="prezzo_min" style="width: 60%" id="prezzo_min" placeholder="€"></label></p>
                            <label for="" class="mt-2 text-center" style="color: red">Prezzo Max:
                            <p><input type="text" class="form-control ml-5" style="width: 60%" name="prezzo_max" id="prezzo_max" placeholder="€"></label></p>
                            <button type="submit" id="buttonfilter" class="btn btn-primary">Applica</button>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                              <div class="card-body">
                              </div>
                            </div>
                          </div>
                          {{-- <div class="card">
                            <div class="card-header" id="headingTwo">
                              <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  Collapsible Group
                                </button>
                              </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                              <div class="card-body">
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingThree">
                              <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  Collapsible Group
                                </button>
                              </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                              <div class="card-body">
                              </div>
                            </div>
                          </div>
                        </div> --}}
                  </div>
              </form>
            </aside>
            <section class="py-4 content-section-admin">
                @yield('content')
            </section>
            
        </main>
    </div>
    @yield('scripts')
{{--     <script type="text/javascript">
       // FILTRO PER PREZZO          
                 (function () {
  function filter() {
    let min = document.getElementById('prezzo_min').value;
    let max = document.getElementById('prezzo_max').value;
    console.log(min, max);
  }

  document.getElementById('buttonfilter').addEventListener('click', filter, true);
})();
           
    
    </script> --}}
</body>
</html>
