@extends('_layout.homepage.index')
@section('content')
    {{--Promo & Visitor Favorite--}}
    <div class="ui vertical segment container">
        <div class="ui two column divided grid">
            <div class="row">
                <div class="column">
                    <div class="ui left aligned grid" id="promo">
                        <div class="eight wide column">
                            <h3>Promo</h3>
                        </div>
                        <div class="right floated right aligned eight wide column">
                            <a href="#">Lihat Semua</a>
                        </div>
                    </div>
                    <img class="ui image" src="https://ecs7.tokopedia.net/img/banner/2017/5/11/16723082/16723082_268a9443-2884-4bb9-b963-6d56529d37bc.jpg.webp" alt="">
                </div>
                <div class="column">
                    <div class="ui left aligned grid">
                        <div class="eight wide column">
                            <h3>Favorit Pengunjung</h3>
                        </div>
                        <div class="right floated right aligned eight wide column">
                            <a href="#">Lihat Semua</a>
                        </div>
                    </div>
                    <div class="ui fluid card">
                        <div class="ui pointing secondary menu">
                            <a class="item active" data-tab="first">Makanan</a>
                            <a class="item" data-tab="second">Minuman</a>
                            <a class="item" data-tab="third">Snack</a>
                        </div>
                        <div class="ui active tab" data-tab="first">
                            <div class="ui divided items">
                                <div class="item">
                                    <div class="middle aligned content">
                                        <a href="#">Makanan A</a>
                                        <div class="ui star rating right floated" data-rating="5"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="middle aligned content">
                                        <a href="#">Makanan B</a>
                                        <div class="ui star rating right floated" data-rating="4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ui tab" data-tab="second">
                            <div class="ui divided items">
                                <div class="item">
                                    <div class="middle aligned content">
                                        <a href="#">Minuman A</a>
                                        <div class="ui star rating right floated" data-rating="4"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="middle aligned content">
                                        <a href="#">Minuman B</a>
                                        <div class="ui star rating right floated" data-rating="4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ui tab" data-tab="third">
                            <div class="ui divided items">
                                <div class="item">
                                    <div class="middle aligned content">
                                        <a href="#">Snack A</a>
                                        <div class="ui star rating right floated" data-rating="4"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="middle aligned content">
                                        <a href="#">Snack B</a>
                                        <div class="ui star rating right floated" data-rating="3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Recomended Cafe / Restaurant--}}
    <div class="ui vertical stripe quote segment container">
        <h3>Rekomendasi Toko</h3>
        <div class="ui eight doubling cards">
            @foreach($cafes as $cafe)
            <a class="card" href="#">
                <div class="image">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlHfIvsQ2CtsjxMC-GVIJFu7ab5I9GTdsMS5pelqZCFfvAYortrg">
                </div>
                <div class="content">
                    <div class="header" style="align-content: center;">{{ $cafe->name }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    {{--Cafe / Restaurant with Their Products--}}
    <div class="ui vertical segment container">
        <div class="ui text">
            <h3 class="ui header">Jelang Ramadhan, Berbuka dan Sahur, Kulinerae!</h3>
            <div class="ui card stack fluid">
                <div class="image">
                    <img src="https://s-media-cache-ak0.pinimg.com/736x/5f/a3/57/5fa357e1da427ab833c03b6d25701e7c.jpg">
                </div>
                <div class="content">
                    <div class="ui four column grid">
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="http://media.nationalgeographic.co.id/daily/640/0/201606161542243/b/foto-4-manfaat-kopi-untuk-kecantikan.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="https://bellnu.files.wordpress.com/2016/03/5-consejos-para-dormir-mas-rapido-segun-los-cientificos-5.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>

                            </div>
                        </div>
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="http://manfaat.co.id/wp-content/uploads/2014/08/kopi.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>

                            </div>
                        </div>
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="http://media.nationalgeographic.co.id/daily/640/0/201401131420290/b/foto-rutin-minum-kopi-turunkan-resiko-kematian-dini.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui card stack fluid">
                <div class="image">
                    <img src="http://bashooka.com/wp-content/uploads/2013/02/coffee-logos-54.png">
                </div>
                <div class="content">
                    <div class="ui four column grid">
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="http://media.nationalgeographic.co.id/daily/640/0/201606161542243/b/foto-4-manfaat-kopi-untuk-kecantikan.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="https://bellnu.files.wordpress.com/2016/03/5-consejos-para-dormir-mas-rapido-segun-los-cientificos-5.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="http://manfaat.co.id/wp-content/uploads/2014/08/kopi.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="http://media.nationalgeographic.co.id/daily/640/0/201401131420290/b/foto-rutin-minum-kopi-turunkan-resiko-kematian-dini.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui card stack fluid">
                <div class="image">
                    <img src="https://s-media-cache-ak0.pinimg.com/736x/ab/ee/47/abee4771b5136fc60a70489218d28563.jpg">
                </div>
                <div class="content">
                    <div class="ui four column grid">
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="http://media.nationalgeographic.co.id/daily/640/0/201606161542243/b/foto-4-manfaat-kopi-untuk-kecantikan.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="https://bellnu.files.wordpress.com/2016/03/5-consejos-para-dormir-mas-rapido-segun-los-cientificos-5.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="http://manfaat.co.id/wp-content/uploads/2014/08/kopi.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui fluid card">
                                <a class="image">
                                    <img src="http://media.nationalgeographic.co.id/daily/640/0/201401131420290/b/foto-rutin-minum-kopi-turunkan-resiko-kematian-dini.jpg">
                                </a>
                                <div class="extra">Rp. 10.000,-</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Hot List--}}
    <div class="ui vertical stripe quote segment container">
        <h3>Trending</h3>
        <div class="ui four doubling cards">
            <div class="card">
                <a class="image" href="#">
                    <img src="https://i.ytimg.com/vi/EvqLHP51klA/hqdefault.jpg">
                </a>
                <div class="content">
                    <a class="header">Makanan W</a>
                    <div class="meta">
                        <i class="heart icon"></i>
                        294x dipesan
                    </div>
                </div>
            </div>
            <div class="card">
                <a class="image" href="#">
                    <img src="https://resepterupdate.com/wp-content/uploads/2016/07/resep-ayam-penyet-surabaya.png">
                </a>
                <div class="content">
                    <a class="header">Makanan X</a>
                    <div class="meta">
                        <i class="heart icon"></i>
                        273x dipesan
                    </div>
                </div>
            </div>
            <div class="card">
                <a class="image" href="#">
                    <img src="http://selerasa.com/images/ikan/resep_kepiting/21.jpg">
                </a>
                <div class="content">
                    <a class="header">Makanan Y</a>
                    <div class="meta">
                        <i class="heart icon"></i>
                        243x dipesan
                    </div>
                </div>
            </div>
            <div class="card">
                <a class="image" href="#">
                    <img src="https://mysexychef.files.wordpress.com/2012/08/gudeg.jpg">
                </a>
                <div class="content">
                    <a class="header">Makanan Z</a>
                    <div class="meta">
                        <i class="heart icon"></i>
                        224x dipesan
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Category--}}
    <div class="ui vertical stripe quote segment container">
        <h3>Lokasi</h3>
        <table class="ui celled table">
            <tr>
                <td class="selectable">
                    <a href="#">Olahan Sapi</a>
                </td>
                <td class="selectable">
                    <a href="#">Olahan Ayam</a>
                </td>
                <td class="selectable">
                    <a href="#">Olahan Kambing</a>
                </td>
            </tr>
            <tr>
                <td class="selectable">
                    <a href="#">Jus</a>
                </td>
                <td class="selectable">
                    <a href="#">Kopi</a>
                </td>
                <td class="selectable">
                    <a href="#">Teh</a>
                </td>
            </tr>
            <tr>
                <td class="selectable">
                    <a href="#">Masakan Rumah</a>
                </td>
                <td class="selectable">
                    <a href="#">Masakan Korea</a>
                </td>
                <td class="selectable">
                    <a href="#">Masakan Jepang</a>
                </td>
            </tr>
        </table>
    </div>
    {{--Lokasi--}}
    <div class="ui vertical stripe quote segment container">
        <h3>Kategori</h3>
        <table class="ui celled table">
            <tr>
                <td class="selectable">
                    <a href="#">Cafe</a>
                </td>
                <td class="selectable">
                    <a href="#">Restauran</a>
                </td>
                <td class="selectable">
                    <a href="#">Mall</a>
                </td>
            </tr>
            <tr>
                <td class="selectable">
                    <a href="#">Pinggir Pantai</a>
                </td>
                <td class="selectable">
                    <a href="#">Pinggir Danau</a>
                </td>
                <td class="selectable">
                    <a href="#">Pegunungan</a>
                </td>
            </tr>
            <tr>
                <td class="selectable">
                    <a href="#">Pedesaan</a>
                </td>
                <td class="selectable">
                    <a href="#">Perkotaan</a>
                </td>
                <td class="selectable">
                    <a href="#">Pinggiran</a>
                </td>
            </tr>
        </table>
    </div>
    {{--Footer--}}
    <div class="ui vertical footer segment">
        <div class="ui container">
            <div class="ui stackable divided equal height stackable grid">
                <div class="five wide column">
                    <h4 class="ui header">About</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Sitemap</a>
                        <a href="#" class="item">Contact Us</a>
                        <a href="#" class="item">Religious Ceremonies</a>
                        <a href="#" class="item">Gazebo Plans</a>
                    </div>
                </div>
                <div class="six wide column">
                    <h4 class="ui header">Services</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Banana Pre-Order</a>
                        <a href="#" class="item">DNA FAQ</a>
                        <a href="#" class="item">How To Access</a>
                        <a href="#" class="item">Favorite X-Men</a>
                    </div>
                </div>
                <div class="five wide column">
                    <h4 class="ui header">Footer Header</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab beatae dolorem itaque neque praesentium?</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}">
@endsection
@section('javascripts')
    <script>
        $(document).ready(function() {
            $('.ui.rating').rating({
                maxRating: 5
            }).rating('disable');
            $('.menu .item').tab();
            // fix menu when passed
            $('.masthead')
                .visibility({
                    once: false,
                    onBottomPassed: function() {
                        $('.fixed.menu').transition('fade in');
                    },
                    onBottomPassedReverse: function() {
                        $('.fixed.menu').transition('fade out');
                    }
                });
            // create sidebar and attach to menu open
            $('.ui.sidebar').sidebar('attach events', '.toc.item');
        });
    </script>
@endsection