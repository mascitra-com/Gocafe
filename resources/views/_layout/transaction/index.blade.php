<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @yield('header')
    <title>Kulinerae | @yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/jqueryui/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-order.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-helper.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/star-rating/css/star-rating.css')}}">
    {{--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400" rel="stylesheet">--}}
    @yield('styles')
    <style>
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
            color: #F18803;
            background-color: #723834;
        }
        @if(str_contains(Route::currentRouteAction(), 'order' ))
            body {
            overflow: hidden;
        }
        @endif
    </style>
</head>
<body>
<div class="container-fluid" id="wrapper">
    <div id="main-panel">
        <nav class="navbar navbar-default" id="nav-top" style="z-index: 99">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('') }}" id="btn-menu" data-menu="#nav-side"><i
                                class="fa fa-bars btn-responsive"></i>KULINERAE</a>
                </div>
                @yield('navbar-right')
            </div>
        </nav>
        <div id="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@yield('modal')
</body>
<script src="{{URL::asset('plugins/jquery/jquery-3.1.1.min.js')}}"></script>
<script src="{{URL::asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('plugins/jqueryui/js/jquery-ui.min.js')}}"></script>
<script src="{{URL::asset('plugins/theme/js/theme-dashboard.js')}}"></script>
<script src="{{URL::asset('plugins/theme/js/theme-helper.js')}}"></script>
<script src="{{URL::asset('plugins/star-rating/js/star-rating.js')}}"></script>
@yield('javascripts')
</html>
