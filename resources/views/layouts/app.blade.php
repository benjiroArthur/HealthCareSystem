<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <meta name="user-id" content="{{ Auth::user()->id }}">
        <meta name="status" content="{{ Auth::user()->active }}">
    @else
        <meta name="user-id" content="0">
        <meta name="status" content="0">
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

        *{
            margin: 0;
            padding: 0;
        }
        html, body{
            height: 100% !important;
        }
        #bgg:hover
        {
            color: black;
            background-color:transparent;
        }
        #bgg
        {
            padding-right: 25px;
            padding-left: 25px;
            color: black;
            border: 2px blue;
            text-decoration: #1fad83;
        }
        #bgg1:hover{
            border-bottom: 2px solid blue;
        }
        #bgg:active{
            border-bottom: 2px solid blue;
        }
        #footer{
            position: relative;
            height: 70px;
            margin-top: -70px;
            clear: both;
            border-top: 1px solid grey;
            padding-top: 10px;
        }
        .cont{
            min-height: 100%
        }
        #main{
            overflow: auto;
            padding-bottom: 70px;
        }

    </style>
</head>
<body>
    <div id="app" class="cont">
        <div class="wrapper" id="main">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container" style="height: 100%">
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

                        @auth
                        <li class="nav-item active" id="bgg1">
                            <a class="nav-link" href="{{url('/home')}}" id="bgg">Home <span class="sr-only">(current)</span></a>
                        </li>
                        @endauth
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

        <main class="py-4" style="height: 100%">

                <div class="container-fluid mt-3">
            @include('includes.messages')
            @yield('content')
                </div>

        </main>
        </div>

    </div>
    <footer id="footer">
        <div class="row container mb-2">
            <!-- Default to the left -->
            <div class="clo-sm-12 col-md-12 col-lg-8 text-center"> <strong>Copyright &copy; {{date('Y')}} <a href="#">  Health Care System  </a>.</strong> All rights reserved.</div>
            <div class="clo-sm-12 col-md-12 col-lg-4 float-right d-sm-inline pl-2 text-center">
                Your Health Our Concern
                <a href="#banner"><span class="fas fa-arrow-alt-circle-up" style="float: right; width: 40px; height: 40px;"></span></a>
            </div>

        </div>
    </footer>
@yield('script')
</body>
</html>
