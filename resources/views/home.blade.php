<!doctype html>
<html lang="en">
    <head>  
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css"ho href="{{ asset('plugins/semantic-ui/semantic.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    </head>
    <body>

    <!-- Following Menu -->
    <div class="ui large top fixed hidden menu">
        <a class="item"><b>KULINERAE</b></a>
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
                <div class="card">
                    <div class="image">
                        <img src="data:image/jpeg;base64,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">
                    </div>
                    <div class="extra">
                        Rating:
                        <div class="ui star rating" data-rating="4"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="data:image/jpeg;base64,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+5kn9He1XeiDkGoocRwqbM5tRSv4Z2kta7szt5rx2XKmeA7766IBtRHHUjTnf4Tz4t5p9i6Imia5pa5ocDxDgCD3gqIYvuvwuouXUrY3H40JMZ77N09yCIHfHhdXHyNbSSZDYlr2RzMuOBGt7jrssnBNttm6aQzU4EDy3KS2CcXFwbWa0jiF8Vu4ajdcxVNRH1B3JyAe4H3rWHyf9dMR07ab/wDZBm4ntTsxLM+oljbNK/VzjBOS4gAcHADgFhDephFJfzHDed0OEcMN/tau9y+4dwDQefiDiPm04b7zIVuqDcbh7NZJKiXve1g9jGg+9BXu0G+nEJwWw8nStPSwZ3/ffw8ACtPhGw+KYnJypjlOb0p6kuaPa/nOGvxQV0XguxVBSWMFLE1w+MW5n/edcqQIKz2O3OUlKWy1J86lGtnC0TT2M+N9q/cFZbW2FhoBov1EBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREH/2Q==">
                    </div>
                    <div class="extra">
                        Rating:
                        <div class="ui star rating" data-rating="2"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="data:image/jpeg;base64,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">

                    </div>
                    <div class="extra">
                        Rating:
                        <div class="ui star rating" data-rating="3"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwqWDQpevLM_GKHZ5abhTVzdvBseaDGjXz2DOVzcC6kT9eAg6-hQ">
                    </div>
                    <div class="extra">
                        Rating:
                        <div class="ui star rating" data-rating="4"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSfmxuHadfzaKEcXGGbsFYQwq3sZ-L0Alfyl2fuHRYUx4_ipZ5xA">
                    </div>
                    <div class="extra">
                        Rating:
                        <div class="ui star rating" data-rating="3"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9qcjst3c70roNrI_tb7Nr7LkCur7JchffS9sw55AnJExL0MOC">
                    </div>
                    <div class="extra">
                        Rating:
                        <div class="ui star rating" data-rating="3"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_dqVjtf8Fwe5C6Bo7IpFY9MMR5q0O4bFhfvWOl-XpaHwMRIVO">
                    </div>
                    <div class="extra">
                        Rating:
                        <div class="ui star rating" data-rating="4"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlHfIvsQ2CtsjxMC-GVIJFu7ab5I9GTdsMS5pelqZCFfvAYortrg">
                    </div>
                    <div class="extra">
                        Rating:
                        <div class="ui star rating" data-rating="4"></div>
                    </div>
                </div>
            </div>
        </div>
        {{--Cafe / Restaurant with Their Products--}}
        <div class="ui vertical segment container">
            <div class="ui text">
                <h3 class="ui header">Jelang Ramadhan, Berbuka dan Sahur, Kulinerae!</h3>
                <div class="ui card stack fluid">
                    <div class="image">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxQCHs8j_a_5P-JbijmLlUueOXf_QrEHIF3dhIS8H-ZfvBlat8HQ">
                    </div>
                    <div class="content">
                        <div class="ui four column grid">

                            <div class="column">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="http://media.nationalgeographic.co.id/daily/640/0/201606161542243/b/foto-4-manfaat-kopi-untuk-kecantikan.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="https://bellnu.files.wordpress.com/2016/03/5-consejos-para-dormir-mas-rapido-segun-los-cientificos-5.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="http://manfaat.co.id/wp-content/uploads/2014/08/kopi.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="http://media.nationalgeographic.co.id/daily/640/0/201401131420290/b/foto-rutin-minum-kopi-turunkan-resiko-kematian-dini.jpg">
                                    </div>
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
                                    <div class="image">
                                        <img src="http://media.nationalgeographic.co.id/daily/640/0/201606161542243/b/foto-4-manfaat-kopi-untuk-kecantikan.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="https://bellnu.files.wordpress.com/2016/03/5-consejos-para-dormir-mas-rapido-segun-los-cientificos-5.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="http://manfaat.co.id/wp-content/uploads/2014/08/kopi.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="http://media.nationalgeographic.co.id/daily/640/0/201401131420290/b/foto-rutin-minum-kopi-turunkan-resiko-kematian-dini.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui card stack fluid">
                    <div class="image">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_vWnOpKkgxw6KXzqKe4bTL8vWnQJPaxuGIY3FSJAa6WYAp0BM">
                    </div>
                    <div class="content">
                        <div class="ui four column grid">
                            <div class="column">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="http://media.nationalgeographic.co.id/daily/640/0/201606161542243/b/foto-4-manfaat-kopi-untuk-kecantikan.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="https://bellnu.files.wordpress.com/2016/03/5-consejos-para-dormir-mas-rapido-segun-los-cientificos-5.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="http://manfaat.co.id/wp-content/uploads/2014/08/kopi.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="http://media.nationalgeographic.co.id/daily/640/0/201401131420290/b/foto-rutin-minum-kopi-turunkan-resiko-kematian-dini.jpg">
                                    </div>
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
        <div class="ui inverted vertical footer segment">
            <div class="ui container">
                <div class="ui stackable inverted divided equal height stackable grid">
                    <div class="three wide column">
                        <h4 class="ui inverted header">About</h4>
                        <div class="ui inverted link list">
                            <a href="#" class="item">Sitemap</a>
                            <a href="#" class="item">Contact Us</a>
                            <a href="#" class="item">Religious Ceremonies</a>
                            <a href="#" class="item">Gazebo Plans</a>
                        </div>
                    </div>
                    <div class="three wide column">
                        <h4 class="ui inverted header">Services</h4>
                        <div class="ui inverted link list">
                            <a href="#" class="item">Banana Pre-Order</a>
                            <a href="#" class="item">DNA FAQ</a>
                            <a href="#" class="item">How To Access</a>
                            <a href="#" class="item">Favorite X-Men</a>
                        </div>
                    </div>
                    <div class="seven wide column">
                        <h4 class="ui inverted header">Footer Header</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab beatae dolorem itaque neque praesentium?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('plugins/jquery/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('plugins/semantic-ui/semantic.min.js') }}"></script>
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
    </body>
</html>