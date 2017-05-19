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
    <a class="item" href="{{ url('/') }}"><b>KULINERAE</b></a>
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
        <a href="{{ url('register') }}" class="item">Daftar</a>
        <a href="{{ url('login') }}" class="item">Masuk</a>
    </div>
</div>

<!-- Page Contents -->
<div class="pusher">
    @yield('content')
    {{--Footer--}}
    <div class="ui vertical footer segment">
        <div class="ui container">
            <div class="ui stackable divided equal height stackable grid">
                <div class="five wide column">
                    <h4 class="ui header">Kulinerae</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Tentang Kami</a>
                        <a href="#" class="item">Media Kit</a>
                        <a href="#" class="item">Kegiatan Kami</a>
                        <a href="#" class="item">Kisah Penjual</a>
                    </div>
                </div>
                <div class="six wide column">
                    <h4 class="ui header">Beli</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Kuliner di Kulinerae</a>
                        <a href="#" class="item">Hot List</a>
                        <a href="#" class="item">Trending</a>
                    </div>
                </div>
                <div class="five wide column">
                    <h4 class="ui header">Kontak</h4>
                    <table width="100%">
                        <tr>
                            <td width="25%"><i class="fa fa-facebook-square"></i> Facebook</td>
                            <td width="50%">: <a href="#">Kulinerae</a></td>
                        </tr>
                        <tr>
                            <td width="25%"><i class="fa fa-twitter-square"></i> Twitter</td>
                            <td width="50%">: <a href="#">Kulinerae</a></td>
                        </tr>
                        <tr>
                            <td width="25%"><i class="fa fa-instagram"></i> Instagram</td>
                            <td width="50%">: <a href="#">Kulinerae</a></td>
                        </tr>
                        <tr>
                            <td width="25%"><i class="fa fa-phone-square"></i> Contact</td>
                            <td width="50%">: (+62) 000 000</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('modal')
<script src="{{ asset('plugins/jquery/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('plugins/semantic-ui/semantic.min.js') }}"></script>
@yield('javascripts')
</body>
</html>