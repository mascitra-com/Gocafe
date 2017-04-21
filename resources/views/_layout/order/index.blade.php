<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @yield('header')
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/jqueryui/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-order.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-helper.css')}}">
    {{--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400" rel="stylesheet">--}}
    @yield('styles')
    <style>
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
            color: #F18803;
            background-color: #723834;
        }
    </style>
</head>
<body style="overflow: hidden">
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
                    <a class="navbar-brand" href="#" id="btn-menu" data-menu="#nav-side"><i
                                class="fa fa-bars btn-responsive"></i>@yield('page_title')</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-shopping-cart text-secondary"></i> <span class="text-secondary">Pesanan</span><span
                                        class="caret text-secondary" id="cart"></span></a>
                            <div class="dropdown-menu" style="width: 500px">
                                <form action="{{ url('order') }}" method="POST" style="margin: .5em .5em">
                                    {{ csrf_field() }}
                                    <table class="table text-quintuple" id="bill">
                                        <thead>
                                        <tr>
                                            <th width="5%"></th>
                                            <th width="37.5%">Nama</th>
                                            <th width="27.5%">Jumlah</th>
                                            <th width="25%">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <table class="table text-quintuple">
                                        <tr>
                                            <td style="font-weight: bold; font-size: 16px" colspan="2">Total Keseluruhan</td>
                                            <td colspan="2" class="text-right"><label class="total price" for="price" style="font-size: 16px">Rp. 0</label></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; font-size: 16px" colspan="2">Total Diskon</td>
                                            <td colspan="2" class="text-right"><label class="discount price" for="price" style="font-size: 16px">- Rp. 0</label></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; font-size: 16px" colspan="2">Total Pembayaran</td>
                                            <td colspan="2" class="text-right"><label class="final price" for="price" style="font-size: 16px">Rp. 0</label></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><button class="btn btn-primary btn-block" type="submit"><b style="font-size: 16px">Pesan</b></button></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
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
@yield('javascripts')
</html>
