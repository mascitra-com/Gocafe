<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/semantic.min.css') }}">
    @yield('styles')
</head>
<body>

<!-- Following Menu -->
<div class="ui large top fixed hidden menu">
    <a class="item" href="{{ url('home') }}"><b>KULINERAE</b></a>
    <a class="category item">
        Kategori
        <i class="dropdown icon"></i>
    </a>
    <div class="ui item" style="width: 70%">
        <div class="ui fluid action input">
            <input type="text" placeholder="Cari Produk atau Cafe...">
            <select class="ui compact selection dropdown" id="location" style="border-left: none">
                <option value="all">Semua Lokasi</option>
                <option value="articles">Jember</option>
                <option value="products">Lumajang</option>
            </select>
            <button class="ui brown button" type="submit">Cari</button>
        </div>
        <div class="results"></div>
    </div>
    <div class="right menu">
        <a class="item">Daftar</a>
        <a class="item">Masuk</a>
    </div>
</div>

<!-- Page Contents -->
<div class="pusher">
    @yield('content')
</div>
@yield('modal')
<script src="{{ asset('plugins/jquery/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('plugins/semantic-ui/semantic.min.js') }}"></script>
@yield('javascripts')
</body>
</html>