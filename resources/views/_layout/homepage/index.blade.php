<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>@yield('page_title') | Kulinerae.com</title>
    <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/semantic.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}">
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
            <div class="ui search selection dropdown" id="location" style="border-left: none">
                <input type="hidden" name="location">
                <i class="dropdown icon"></i>
                <div class="default text">Pilih Lokasi</div>
                <div class="menu" id="provinceList"></div>
            </div>
            <a href="{{ url('product') }}" class="ui brown button" type="submit">Cari</a>
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
                    <h4 class="ui header">Bantuan</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Syarat dan Ketentuan</a>
                        <a href="#" class="item">Kebijakan Privasi</a>
                        <a href="#" class="item">Pusat Resolusi</a>
                        <a href="#" class="item">Hubungi Kami</a>
                        <a href="#" class="item">Panduan Keamanan</a>
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
                            <td width="50%">: <a href="#">@kulinerae</a></td>
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
    <div class="ui vertical footer segment">
        <div class="ui container" style="color: rgba(0,0,0,.4); font-size: 9pt">
            <div class="ui left aligned grid">
                <div class="eight wide column">
                    <p>&copy; 2017, PT. Kulinerae</p>
                    <p>Server process time: {{ number_format((microtime(true) - LARAVEL_START), 3) }}</p>
                </div>
                <div class="right floated right aligned eight wide column">
                    <div class="ui buttons">
                        <button class="ui brown button active">Indonesia</button>
                        <button class="ui brown basic button">English</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('modal')
<script src="{{ asset('plugins/jquery/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('plugins/semantic-ui/semantic.min.js') }}"></script>
<script>
    var hostname = window.location.hostname;
    $(document).ready(function() {
        $('#location')
            .dropdown({
                fullTextSearch: true
            });
        $.ajax({
            url: "https://"+ hostname + '/get-provinces',
            dataType: 'json',
            success: function (response) {
                var markup = "";
                $.each(response.cities, function (i, city) {
                    markup += "<div class='item' data-value='"+city.id+"'>"+city.name+"</div>";
                });
                $("#provinceList").append(markup);
            }
        });
    });
</script>
@yield('javascripts')
</body>
</html>