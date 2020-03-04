<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    @if(Auth::check())--}}
{{--        <meta name="user-image" content="{{ Auth()->user()->userable->image }}">--}}
{{--    @endif--}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HEALTH CARE SYSTEM') }}</title>
{{--Script--}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
@include('includes.navbar')

@include('includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid mt-3">
            @include('includes.messages')

            {{--<div id="div-route-content">--}}
                <router-view>
                    @yield('content')
                    {{--Vue elements goes here--}}
                </router-view>
                <vue-progress-bar></vue-progress-bar>
            {{--</div>--}}
        </div>

    </div>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->

   <div class="row">
       <!-- Default to the left -->
      <div class="clo-sm-12 col-md-12 col-lg-8 text-center"> <strong>Copyright &copy; {{date('Y')}} <a href="#">  Health Care System  </a>.</strong> All rights reserved.</div>
       <div class="clo-sm-12 col-md-12 col-lg-4 float-right d-sm-inline pl-2 text-center">
           Your Health Our Concern
       </div>
   </div>
</footer>
</div>

<!-- ./wrapper -->

{{--scripts--}}
<!-- Scripts -->

{{--<script>

    $(document).ready(function(){
        $('#div-route-content').html('<router-view>\n' +
            '\n' +
            '                    --}}{{--Vue elements goes here--}}{{--\n' +
            '                </router-view>');
    });

    function showContent()
    {
        $("#home-content").show();
    }

    function hideContent(){
        $('#home-content').hide();
    }
</script>--}}
@yield('script')

</body>
</html>
