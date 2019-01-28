@extends('_layout.homepage.index')
@section('page_title', 'Rekomendasi Toko')
@section('content')
    <div class="ui vertical segment container" id="shop-list">
        <div class="ui text">
            <div class="ui left aligned grid" style="margin-bottom: 1em">
                <div class="eight wide column">
                    <h3>Rekomendasi Toko & Kafe dengan Menu Paling banyak disukai!</h3>
                </div>
            </div>
            <div id="list">
                @foreach($recommended as $recommend)
                    <div class="ui card stack fluid">
                        <a href="{{ url('shop/'.$recommend->slug) }}" class="image" style="width: 230px; height: 270px">
                            <img src="{{ $recommend->logo }}" height="400px">
                        </a>
                        <div class="content">
                            <div class="ui five column grid">
                                @foreach($recommend->latestMenu as $product)
                                    <a class="column" href="{{ url('product/'.$product->id) }}">
                                        <div class="ui fluid card">
                                            <div class="image" style="width: 149px; height: 120px">
                                                <img src="{{ url("$product->thumbnail") }}">
                                            </div>
                                            <div class="content">
                                                <div class="header">{{ $product->name }}</div>
                                                <span>
                                                @if($product->discount)
                                                    <del style="color: grey" class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</del>&nbsp;
                                                    <b class="price">Rp. {{ number_format($product->price - ($product->price * $product->discount), 0, ',', '.') }}</b>
                                                @else
                                                    <b class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</b>
                                                @endif
                                                </span>
                                            </div>
                                            <div class="extra content">
                                                <div class="ui mini heart rating" data-rating="0" data-max-rating="1"></div> {{ $product->liked }}
                                                <span class="right floated">
                                                    <div class="ui mini star rating" data-rating="{{ floor($product->rating) }}"></div>
                                                    ({{ $product->reviewed }})
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="ui large centered inline text loader">
                    Adding more content...
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.min.js"></script>
    <script src="{{ asset('plugins/imagefill/js/jquery-imagefill.js') }}"></script>
    <script src="{{ asset('plugins/js/shop.js') }}"></script>
    <script>
        $('div.image').imagefill();
        $('a.image').imagefill();
        var hostname = window.location.hostname;
        var offset = {{ count($recommended) }};
        $('#shop-list')
            .visibility({
                once       : false,
                observeChanges: true,
                offset: 1000,
                onBottomPassed  : function() {
                    loadMore();
                }
            });

        function loadMore() {
            $.ajax({
                url: "https://"+ hostname + '/load-recommended/' + offset,
                dataType: 'json',
                success: function (response) {
                    $.each(response.recommended, function (i, recommended) {
                        var products = "";
                        var markup = "<div class='ui card stack fluid'><a href='https://"+ hostname + "/shop/"+recommended.slug+"' class='image' style='width: 230px; height: 270px'><img src='"+ recommended.logo +"'></a><div class='content'><div class='ui five column grid'>";
                        $.each(recommended.latestMenu, function (i, menu) {
                            var price = 0;
                            if(menu.discount) {
                                price = "<del style='color: grey' class='price'>Rp. "+ $.number(menu.price) +"</del>&nbsp;<b class='price'>Rp. "+ $.number(menu.price - (menu.price * menu.discount)) +"</b>";
                            } else {
                                price = "<b class='price'>Rp. "+ $.number(menu.price) +"</b>";
                            }
                            var image = "<div class='image' style='width: 149px; height: 120px'><img src='"+ menu.thumbnail +"'></div>";
                            var content = "<div class='content'><div class='header'>" + menu.name + "</div><span>" + price + "</span></div>";
                            var liked = "<div class=\"ui mini heart rating\" data-rating=\"0\" data-max-rating=\"1\"></div>" + menu.liked;
                            var rating = "<span class='right floated'><div class='ui mini star rating' data-rating='"+Math.floor(menu.rating)+"'></div> ("+menu.reviewed+")</span>";
                            var extra = "<div class=\"extra content\">" + liked + rating + "</div>";
                            markup += "<a class='column' href='https://"+ hostname + "/product/"+menu.id+"'><div class='ui fluid card'>" + image + content + extra + "</div></a>";
                            $('.ui.heart.rating').rating('enable');
                            $('.ui.star.rating').rating({
                                maxRating: 5
                            }).rating('disable');

                        });
                        markup += "</div></div></div>";
                        $('#list').append(markup);
                    });
                    offset += {{ count($recommended) }};
                    $('div.image').imagefill();
                    $('a.image').imagefill();
                }
            });
        }
    </script>
@endsection