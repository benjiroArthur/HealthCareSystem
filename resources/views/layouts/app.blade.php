<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <meta name="user-id" content="{{ auth::user()->id }}">
        <meta name="status" content="{{ auth::user()->active }}">
    @else
        <meta name="user-id" content="1">
        <meta name="status" content="1">
    @endauth

    <title>{{ config('app.name', 'HealthCare') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .logotext
        {
            font-family: Arial bold; font-size: 16px; font-weight: bolder;
            text-shadow: rgb(110,110,110) 3px 3px 5px;
            color: mediumvioletred;
        }
        .logotext1
        {
            font-family: Arial bold; font-size: 9px; font-weight: bold;
            text-shadow: rgb(110,110,110) 3px 3px 5px;
            color: mediumvioletred;
            text-decoration: none;
        }
        #inout
        {
            background: transparent;
            border: 4px mediumvioletred;
            border-radius: 25px;
            color: white;
            /*top: 20px;*/
            /*position: absolute;*/
            padding: 15px 15px;
        }
        #bgg:hover
        {
            color: white;
            background-color:transparent;
        }
        #bgg
        {
            padding-right: 25px;
            padding-left: 25px;
            color: lightgrey;
            border: 2px mediumvioletred;
            text-decoration: #1fad83;
        }
        #bgg1:hover{
            border-bottom: 2px solid mediumvioletred;
        }
        #bgg:active{
            border-bottom: 2px solid mediumvioletred;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'HealthCare') }} {{--Logo comes Here--}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    {{--middle navbar--}}
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item active" id="bgg1">
                            <a class="nav-link" href="{{url('/home')}}" id="bgg">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item" id="bgg1">
                            <a class="nav-link" href="#about" id="bgg">About</a>
                        </li>
                        <li class="nav-item" id="bgg1">
                            <a class="nav-link" href="#contact" id="bgg">Contact</a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <div class="display-avatar bg-inverse-primary text-primary">
                                        <img class="img-md rounded-circle" src="{{auth()->user()->userable->image}}" alt="AS" height="20">
                                    </div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">
                                        <span class="profile-text">{{auth()->user()->userable->full_name}}</span>
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>

                            </li>

                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="wrapper">
                <div class="container-fluid mt-3">
            @include('includes.messages')
            @yield('content')
                </div>
            </div>
        </main>
    </div>
@yield('script')
</body>
</html>
