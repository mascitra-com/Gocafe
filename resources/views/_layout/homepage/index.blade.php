<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Kulinerae | @yield('page_title')</title>
    <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/semantic.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}">
    @yield('styles')
</head>
<body>

<!-- Following Menu -->
<div class="ui large top fixed hidden menu">
    <a class="item" href="{{ url('/') }}"><b>KULINERAE</b></a>
    @include('_layout.homepage._categories')
    <div class="ui item" style="width: 60%">
        <form action="{{ url('search') }}" class="ui action input" method="GET" id="search">
            <input type="text" name="query" placeholder="Cari Produk atau Cafe..." value="{{ empty($filter['query']) ? '' :  $filter['query']}}" id="query">
            <div class="ui search selection dropdown" id="location" style="border-left: none">
                <input type="hidden" name="">
                <i class="dropdown icon"></i>
                <div class="default text">Semua Lokasi</div>
                <div class="menu" id="provinceList"></div>
            </div>
            <button class="ui brown button" type="submit">Cari</button>
        </form>
        <div class="results"></div>
    </div>
    <div class="right menu">
        <a href="{{ url('register') }}" class="item">Daftar</a>
        <a href="{{ url('login') }}" class="item">Masuk</a>
        <a href="" class="item button" style="margin-right: 4em"><i class="fa fa-th-large"></i></a>
    </div>
</div>

<!-- Page Contents -->
<div class="pusher">
    @yield('content')
    {{--Footer--}}
    <div class="ui vertical footer segment">
        <div class="ui container">
            <div class="ui equal width grid">
                <div class="four wide column">
                    <h4 class="ui header">Kulinerae</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Tentang Kami</a>
                        <a href="#" class="item">Media Kit</a>
                        <a href="#" class="item">Kegiatan Kami</a>
                        <a href="#" class="item">Kisah Penjual</a>
                    </div>
                </div>
                <div class="four wide column">
                    <h4 class="ui header">Layanan Pelanggan</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Hubungi Kami</a>
                        <a href="#" class="item">Syarat dan Kondisi</a>
                        <a href="#" class="item">Kebijakan Privasi</a>
                        <a href="#" class="item">Peta Situs</a>
                        <a href="#" class="item">Bantuan</a>
                    </div>
                </div>
                <div class="four wide column">
                    <div class="ui header">
                        Fitur Seru Kami
                    </div>
                    <div class="ui link list">
                        <a href="#" class="item">eCoupon</a>
                        <a href="#" class="item">Menjadi Anggota</a>
                        <a href="#" class="item">Kulinerae Mobile App</a>
                        <a href="#" class="item">Kulinerae Affiliate</a>
                        <a href="#" class="item">Kulinerae Marketplace</a>
                    </div>
                </div>
                <div class="four wide column">
                    <div class="ui header">
                        <h4 style="margin-bottom: .1em">Hubungi kami</h4>
                        <h2 style="margin-top: .1em; margin-bottom: .1em">(0331) 4350327</h2>
                        <h5 style="margin-top: .1em">SMS 081230033880</h5>
                    </div>
                    <link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css">
                    <style type="text/css">
                        form#mc-embedded-subscribe-form {
                            padding-top: 0em !important;
                        }
                        #mc_embed_signup {
                            background: #fff;
                            font: 14px Helvetica, Arial, sans-serif;
                        }
                        #mc_embed_signup input.email {
                            width: 100%;
                        }
                        form#mc-embedded-subscribe-form {
                            padding-left: 0;
                            padding-top: 2em;
                        }
                        /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                    </style>
                    <div id="mc_embed_signup">
                        <form action="//facebook.us13.list-manage.com/subscribe/post?u=115f043b7a79237163370cfb5&amp;id=4e5c79ac86"
                              method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
                              target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll">
                                <!--End mc_embed_signup-->
                                <div class="ui message">
                                    <div class="header">
                                        <label for="mce-EMAIL">Newsletter</label>
                                    </div>
                                    <p style="color: grey; margin-top: .1em">Daftarkan alamat e-mail anda untuk mendapatkan info & deal menarik dari Kulinerae</p>
                                    <div class="field">
                                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL"
                                               placeholder="Alamat Email" required>
                                    </div>
                                    <div class="field">
                                        <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                            <input type="text" name="b_115f043b7a79237163370cfb5_4e5c79ac86" tabindex="-1"
                                                   value=""></div>
                                        <div class="clear"><input type="submit" value="Daftar" name="subscribe"
                                                                  id="mc-embedded-subscribe" class="button"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui vertical footer segment">
        <div class="ui container">
            <div class="ui equal width grid">
                <div class="four wide column">
                    <button class="medium ui brown button">
                        <i class="icon bullhorn"></i> Beriklan di Sini
                    </button>
                </div>
                <div class="four wide column">
                    <button class="medium ui brown button">
                        <i class="icon handshake"></i> Berkarir dengan Kami
                    </button>
                </div>
                <div class="four wide column">
                    <a href="https://www.facebook.com/kulinerae"><i class="fa fa-3x fa-facebook-square"></i></a>
                    <a href="https://twitter.com/kulinerae"><i class="fa fa-3x fa-twitter-square"></i></a>
                    <a href="https://www.instagram.com/kulinerae_id/"><i class="fa fa-3x fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-3x fa-google-plus-square"></i></a>
                </div>
                <div class="four wide column">
                    <style>
                        #feedback.ui.icon.message {
                            padding: 0 0;
                            box-shadow: none;
                        }
                    </style>
                    <a href="#">
                        <div class="ui icon message" id="feedback">
                            <i class="mail brown icon"></i>
                            <div class="content">
                                <div class="header">
                                    Kirim Saran
                                </div>
                                <p>Kami dengan Senang Hati Mendengar Saran dari Anda</p>
                            </div>
                        </div>
                    </a>
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
        $('.ui.rating.star').rating({
            maxRating: 5
        }).rating('disable');
        $('.ui.heart.rating')
            .rating('enable')
        ;
        $('.category.item').popup({
            hoverable: true
        });
        $('#location')
            .dropdown({
                fullTextSearch: true
            });
        $.ajax({
            url: "https://"+ hostname + '/get-provinces',
            dataType: 'json',
            success: function (response) {
                var markup = "<div class='item' data-value='0'>Semua Lokasi</div>";
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