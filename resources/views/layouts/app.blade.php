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
    <div class="app">
        <nav class="navbar navbar-light bg-light justify-content-between">
            <div class="container-fluid">
                <div class="col-md-2">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{asset('img/logo/logo_75x100.png')}}" alt="{{ __('app/navbar.altLogo') }}">
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 amber-border" type="text" placeholder="{{ __('app/navbar.searchText') }}" aria-label="Search">
                        <div class="input-group-append">
                            <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search ic-navbar" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <i class="fas fa-globe fa-2x mr-sm-1 ic-navbar"></i>
                    <i class="fas fa-user fa-2x mr-sm-1 ic-navbar"></i>
                    <i class="fas fa-shopping-cart fa-2x mr-sm-1 ic-navbar"></i>
                    <i class="fas fa-sign-out-alt fa-2x mr-sm-1 ic-navbar"></i>
                </div>
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>