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
    <link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-dashboard.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-helper.css')}}">

    {{--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400" rel="stylesheet">--}}
    @yield('styles')
</head>
<body>
<div class="container-fluid" id="wrapper">
    @include('_layout.dashboard._sidebar')
    <div id="main-panel">
        @include('_layout.dashboard._topbar')
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
@yield('javascripts')
</html>
