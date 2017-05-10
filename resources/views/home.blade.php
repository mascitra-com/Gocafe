<!doctype html>
<html lang="en">
    <head>  
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/semantic.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}">
        <style>
            select#location {
                font-size: 10pt;
            }
        </style>
    </head>
    <body>

    <!-- Following Menu -->
    <div class="ui large top fixed hidden menu">
        <div class="ui container">
            <a class="item"><b>GOCAFE</b></a>
            <a class="category item" data-position="bottom right">
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
    </div>

    <!-- Page Contents -->
    <div class="pusher">
        <div class="ui inverted vertical masthead center aligned segment">
            <div class="ui container">
                <div class="ui large secondary inverted pointing menu">
                    <a class="toc item">
                        <i class="sidebar icon"></i>
                    </a>
                    <a class="item">GOCAFE LOGO!</a>
                    <div class="right item">
                        <a class="ui inverted button">Daftar</a>
                        <a class="ui inverted button">Masuk</a>
                    </div>
                </div>
            </div>
            <div class="ui text container">
                <h1 class="ui inverted header">
                    GOCAFE!
                </h1><br>
                <div class="ui item">
                    <div class="ui fluid action input">
                        <input type="text" placeholder="Cari Produk atau Cafe...">
                        <select class="ui compact selection dropdown" style="border-left: none">
                            <option value="all">Semua Lokasi</option>
                            <option value="articles">Jember</option>
                            <option value="products">Lumajang</option>
                        </select>
                        <button class="ui brown button" type="submit">Cari</button>
                    </div>
                    <div class="results"></div>
                </div>
            </div>
        </div>
        <div class="ui vertical stripe segment">
            <div class="ui middle aligned stackable grid container">
                <div class="row">
                    <div class="eight wide column">
                        <h3 class="ui header">We Help Companies and Companions</h3>
                        <p>We can give your company superpowers to do things that they never thought possible. Let us delight your customers and empower your needs...through pure data analytics.</p>
                        <h3 class="ui header">We Make Bananas That Can Dance</h3>
                        <p>Yes that's right, you thought it was the stuff of dreams, but even bananas can be bioengineered.</p>
                    </div>
                    <div class="six wide right floated column">
                        <img src="https://semantic-ui.com/examples/assets/images/wireframe/white-image.png" class="ui large bordered rounded image">
                    </div>
                </div>
                <div class="row">
                    <div class="center aligned column">
                        <a class="ui huge button">Check Them Out</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui vertical stripe quote segment">
            <div class="ui equal width stackable internally celled grid">
                <div class="center aligned row">
                    <div class="column">
                        <h3>"What a Company"</h3>
                        <p>That is what they all say about us</p>
                    </div>
                    <div class="column">
                        <h3>"I shouldn't have gone with their competitor."</h3>
                        <p>
                            <img src="https://semantic-ui.com/examples/assets/images/avatar/nan.jpg" class="ui avatar image"> <b>Nan</b> Chief Fun Officer Acme Toys
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('plugins/semantic-ui/semantic.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.category').popup({
                setFluidWidth: false,
                inline     : true,
                hoverable  : true,
                position   : 'bottom left',
                delay: {
                    show: 300,
                    hide: 800
                }
            });
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