<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Icons -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    <div class="app ">
        <nav class="navbar navbar-light bg-light justify-content-between">
            <div class="container-fluid">
                <div class="col-md-2">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{asset('img/logo/logo_75x100.png')}}" alt="{{ __('app/navbar.altLogo') }}">
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 amber-border" type="text" placeholder="{{ __('app/navbar.searchText') }}" aria-label="Search">
                        <div class="input-group-append">
                            <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search ic-navbar" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                @shop
                    <div class="col-md-1">
                        <a href="#">
                            <i class="fas fa-user mr-sm-1 ic-navbar">&nbsp;{{auth('shop')->user()->name }} {{ __('app/navbar.shop') }}</i>
                        </a>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <i class="fas fa-sign-out-alt mr-sm-1 ic-navbar">&nbsp;Logout</i>
                        </a>
                    </div>
                @endshop
                @visitor
                <div class="col-md-1">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt  mr-sm-1 ic-navbar" aria-hidden="true">
                            &nbsp;Login
                        </i>
                    </a>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('register') }}">
                        <i class="fas fa-user-plus  mr-sm-1 ic-navbar">&nbsp;Register</i>
                    </a>
                </div>
                 <div class="col-md-1">
                    <i class="fas fa-shopping-cart  mr-sm-1 ic-navbar">&nbsp;Cart</i>
                 </div>
                @endvisitor
                @user
                    <div class="col-md-1">
                        <a href="#">
                            <i class="fas fa-user mr-sm-1 ic-navbar">&nbsp;{{auth('web')->user()->name }} {{ __('app/navbar.user')  }}</i>
                        </a>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <i class="fas fa-sign-out-alt mr-sm-1 ic-navbar">&nbsp;Logout</i>
                        </a>
                    </div>
                    <div class="col-md-1">
                        <i class="fas fa-shopping-cart  mr-sm-1 ic-navbar">&nbsp;Cart</i>
                    </div>
                @enduser
                <div class="col-md-1">
                    <i class="fas fa-globe  mr-sm-1 ic-navbar">&nbsp;Lang</i>
                </div>



            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>