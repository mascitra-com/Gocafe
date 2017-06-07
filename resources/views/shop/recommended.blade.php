@extends('_layout.homepage.index')
@section('page_title', 'Rekomendasi Toko')
@section('content')
    <div class="ui vertical segment container" id="shop-list">
        <div class="ui text">
            <div class="ui left aligned grid" style="margin-bottom: 1em">
                <div class="eight wide column">
                    <h3>Jelang Ramadhan, Berbuka dan Sahur, Kulinerae!</h3>
                </div>
            </div>
            <div id="list">
                @foreach($recommended as $recommend)
                    <div class="ui card stack fluid">
                        <div class="image" style="width: 300px; height: 330px">
                            <img src="{{ url('logo/'.$recommend->id) }}">
                        </div>
                        <div class="content">
                            <div class="ui four column grid">
                                @foreach($recommend->latestMenu as $product)
                                    <a class="column" href="{{ url('product/'.$product->id) }}">
                                        <div class="ui fluid card">
                                            <div class="image" style="width: 175px; height: 175px">
                                                <img src="{{ url('menus/showThumbnail/'.$product->id) }}">
                                            </div>
                                            <div class="content">
                                                <div class="header">{{ $product->name }}</div>
                                                <span>
                                                    @if($product->discount)
                                                        <del style="color: grey">Rp. {{ number_format($product->price, 0, ',', '.') }}</del>&nbsp;
                                                        <b>Rp. {{ number_format($product->price - ($product->price * $product->discount), 0, ',', '.') }}</b>
                                                    @else
                                                        <b>Rp. {{ number_format($product->price, 0, ',', '.') }}</b>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="extra content">
                                                <div class="ui heart rating" data-rating="0" data-max-rating="1"></div> {{ $product->liked }}
                                                <span class="right floated">
                                                    <div class="ui tiny star rating" data-rating="{{ floor($product->rating) }}"></div>
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
    <script src="{{ asset('plugins/imagefill/js/jquery-imagefill.js') }}"></script>
    <script>
        $('div.image').imagefill();
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
                        var name = recommended.name;
                        var products = "";
                        console.log(recommended);
                        $.each(recommended.latest_menu, function (i, menu) {
                            console.log(menu.id);
                            products += "<div class='column'><div class='ui fluid card'><a class='image'><img src='" + getThumbnail(menu.id) + "'></a></div></div>";
                        });
                        var markup = "<div class='ui card stack fluid'><div class='image'><img src='https://dummyimage.com/250x250/8C4728/fff.jpg&text=" + name + "'></div><div class='content'><div class='ui four column grid'>" + products + "</div></div></div>";
                        $('#list').append(markup);
                        offset += {{ count($recommended) }};
                    });
                }
            });
        }

        function getThumbnail(idMenu) {
            return "https://" + hostname + "/menus/showThumbnail/" + idMenu;
        }
    </script>
@endsection