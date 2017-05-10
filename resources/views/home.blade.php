<!doctype html>
<html lang="en">
    <head>  
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css"ho href="{{ asset('plugins/semantic-ui/semantic.min.css') }}">
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
    <div class="pusher" style="margin-top: 5em;">
        <div class="ui vertical stripe segment">
            <div class="ui middle aligned stackable grid container">
                <div class="row">
                    <div class="eight wide column">
                        <h3 class="ui header">We Help Companies and Companions</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequatur doloremque earum enim ipsa ipsum iusto laudantium magni quo recusandae. Aliquam animi deleniti esse incidunt magnam nobis provident sit tempore?</p>
                        <h3 class="ui header">We Make Bananas That Can Dance</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur aut consequatur, fugiat illo illum praesentium.</p>
                    </div>
                    <div class="six wide right floated column">
                        <img src="http://www.thebioscope.co.za/wp-content/uploads/2010/12/Chalkboard-Cafe-Johannesburg-The-Bioscope.jpg" class="ui large bordered rounded image">
                    </div>
                </div>
                <div class="row">
                    <div class="center aligned column">
                        <br><a class="ui huge button">Daftarkan Kafemu Disini!</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui vertical stripe quote segment">
            <div class="ui equal width stackable internally celled grid">
                <div class="center aligned row">
                    <div class="column">
                        <h3>"Aliquam animi"</h3>
                        <p>Aspernatur aut consequatur</p>
                    </div>
                    <div class="column">
                        <h3>"Fugiat illo illum praesentium."</h3>
                        <p>
                            <img src="https://semantic-ui.com/examples/assets/images/avatar/nan.jpg" class="ui avatar image"> <b>Nan</b> Earum Enim Ipsa Ipsum
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui vertical stripe segment">
        <div class="ui text container">
            <h3 class="ui header">Breaking The Grid, Grabs Your Attention</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti dignissimos eos nam nesciunt non quis tenetur ullam voluptatibus. Adipisci amet cum eius exercitationem hic minus neque quos ratione reprehenderit voluptatibus.</p>
            <a class="ui large button">Read More</a>
            <h4 class="ui horizontal header divider">
                <a href="#">Lorem Ipsum</a>
            </h4>
            <h3 class="ui header">Did We Tell You About Our Bananas?</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aut dicta esse facere illum molestias placeat quidem. Aliquam animi autem commodi dolor doloribus laudantium quaerat quasi quod?</p>
            <a class="ui large button">I'm Still Quite Interested</a>
        </div>
    </div>
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