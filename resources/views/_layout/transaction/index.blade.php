<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @yield('header')
    <title>Kulinerae | @yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
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
        <nav class="navbar navbar-default navbar-fixed-top" id="nav-top" style="z-index: 99">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div style="margin-top: .5em; margin-left: 1em">
                        @if(isset($firstMenu))
                            <a href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                        @endif
                    <a href="{{ url('/dashboard') }}">
                        <img src="{{ asset('images/logoname-white.png') }}" alt="Kulinerae" class="ui site-logo" height="25px">
                    </a>
                    </div>
                </div>
                @yield('navbar-right')
            </div>
        </nav>
        <div id="content" style="margin-top: 3.5em">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@yield('modal')
</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{URL::asset('plugins/theme/js/theme-dashboard.js')}}"></script>
<script src="{{URL::asset('plugins/theme/js/theme-helper.js')}}"></script>
<script src="{{URL::asset('plugins/star-rating/js/star-rating.js')}}"></script>
@yield('javascripts')
</html>
