@extends('_layout.homepage.index')
@section('page_title', $product->name)
@section('content')
    <div id="fb-root"></div>
    <div class="ui breadcrumb container grid" id="top">
        <div class="twelve wide column">
        <a class="section" href="{{ url('/') }}">Home</a>
        <i class="right angle icon divider"></i>
        <a class="section" href="{{ url('shop/'.$shop->slug) }}">{{ $shop->name }}</a>
        <i class="right angle icon divider"></i>
        <span class="active section">{{ $product->name }}</span>
        </div>
    </div>
    <div class="ui grid container">
        {{-- Main Content --}}
        <div class="twelve wide column">
            <h1 style="color: #8C4728">
                {{ $product->name }}<br>
                <small style="color: #F18803">{{ $product->category->name }}</small>
            </h1>
            <div class="row">
                <div class="column">
                    <span class="fb-share-button" data-href="{{ Request::fullUrl() }}" data-layout="button_count" data-size="large" data-mobile-iframe="false">
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"></a>
                    </span>
                    <a class="twitter-share-button"
                       href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text={{ $product->name }} {{ $product->description }}&hashtags=Kulinerae.com"
                       target="_blank"
                       data-size="large">
                    </a>
                </div>
            </div>
            <div class="ui segment" style="margin-bottom: 1em">
                <div class="ui grid">
                    <div class="row">
                        <div class="six wide column">
                            <div class="row">
                                <div class="column">
                                    <div class="ui fluid image" style="height: 285px; width: 285px">
                                        @if($product->halal)
                                            <div class="ui transparent left corner label">
                                                <img src="{{ asset('images/halal-sign.svg') }}">
                                            </div>
                                        @endif
                                            <img src="{{ url($product->thumbnail) }}" id="big-thumbnail" class="ui image">
                                    </div>
                                </div>
                            </div>
                            <div class="ui equal width grid row" style="margin-top: .25em">
                                @php $images = explode(':', $product->images_name); @endphp
                                @foreach($images as $image)
                                    @if($image !== 'default' && $image !== '')
                                        <div class="column">
                                            <a class="ui tiny image" onclick="changeBigThumbnail('{{ url('/menus/showImage/'.$image) }}')" href="#">
                                                <img src="{{ url('/menus/showImage/'.$image) }}">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="ten wide column">
                            <h4>Deskripsi Produk</h4>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <h4>&nbsp;&nbsp;<i class="fa fa-list"></i> Penilaian Produk</h4>
                            <form id="form-review" action="{{ url('review') }}" class="ui form" method="POST" id="form-review">
                                {{ csrf_field() }}
                                <input type="hidden" name="item_id" value="{{ $product->id }}" id="item_id">
                                <table class="table table-responsive" width="75%" style="margin-left: .5em">
                                    <tr>
                                        <td width="20%"><label>Penilaian Anda</label></td>
                                        <td>
                                            <div class="field">
                                                <div class="ui large star rating" id="field-rating"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Ulasan Anda</label></td>
                                        <td>
                                            <div class="field">
                                            <textarea name="review" class="form-control" id="review" rows="3"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <br><button type="submit" class="ui button pull-right">Simpan</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table class="ui table" id="table-review">
                                <tbody>
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td width='15%'><img src='{{ $review->avatar }}' alt='' class='ui tiny circular image'></td>
                                            <td>
                                                <p><h3>{{ $review->profile->first_name }} {{ $review->profile->last_name }}</h3></p>
                                                <p><div class='ui star rating disable' data-rating='{{ $review->rating }}'></div></p>
                                                <p>{{ $review->review }}</p>
                                                <p><span class='label label-default'>{{ date('d-m-Y H:i', strtotime($review->created_at)) }}</span></p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Sidebar --}}
        <div class="four wide column">
            <div class="ui center aligned segment">
                @if($product->discount)
                    <del style="color: grey">Rp. {{ number_format($product->price, 0, ',', '.') }}</del>
                    <h2 style="color: #8C4728; margin-top: .1em">
                    <b>Rp. {{ number_format($product->price - ($product->price * $product->discount), 0, ',', '.') }}</b>
                    </h2>
                @else
                    <h2 style="color: #8C4728">
                    <b>Rp. {{ number_format($product->price, 0, ',', '.') }}</b>
                    </h2>
                @endif
                <p class="price-last-update">Perubahan Harga Terakhir: {{ date('d-m-Y, H:i') }}</p>
            </div>
            <button class="ui fluid button"><i class="fa fa-heart"></i> &nbsp Tambah ke Wishlist</button>
            <div class="ui center aligned segment container">
                <a href="{{ url('shop/' . $shop->slug) }}">
                <h3 style="color: #8C4728">{{ $shop->name }}</h3>
                <img class="ui centered tiny image" src="{{ url($shop->logo) }}"><br>
                </a>
                @if($shop->facebook)
                    <a target="_blank" href="https://www.facebook.com/{{ $shop->facebook }}"><i class="fa fa-lg fa-facebook-square"></i> {{ $shop->facebook }}</a>
                @endif
                @if($shop->twitter)
                    <a target="_blank" href="https://www.twitter.com/{{ $shop->twitter }}"><i class="fa fa-lg fa-twitter-square"></i> {{ $shop->twitter }}</a><br>
                @endif
                @if($shop->instagram)
                    <a target="_blank" href="https://www.instagram.com/{{ $shop->instagram }}"><i class="fa fa-lg fa-instagram"></i> {{ $shop->instagram }}</a>&nbsp;&nbsp;
                @endif
                @if($shop->phone)
                    <span style="color: #F18803"><i class="fa fa-lg fa-phone-square"></i> {{ $shop->phone }}</span>
                @endif
                <br><br>
                <form action="{{ url('messages/create') }}" method="get">
                    <input type="hidden" name="send_to" value="{{ $shop->slug }}">
                    <button class="ui fluid button brown" type="submit"><i class="fa fa-envelope"></i> &nbsp Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
    @include('homepage._tophit')
@endsection

@section('styles')
    <style>
        .ui.label>img {
            top: 10px !important;
            left: 10px !important;
        }
        .ui.transparent.left.corner.label {
            border-color: transparent;
        }
        .twitter-share-button[style] { vertical-align: text-bottom !important; }
    </style>
    <meta property="og:url"           content="{{ Request::fullUrl() }}" />
    <meta property="og:title"         content="{{ $product->name }}" />
    <meta property="og:description"   content="{{ $product->description }}" />
    <meta property="og:image"         content="{{ url($product->thumbnail) }}" />
@endsection

@section('javascripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js"></script>
    <script src="{{ asset('plugins/imagefill/js/jquery-imagefill.js') }}"></script>
    <script>
        var popupMeta = {
            width: 400,
            height: 400
        }
        $("#form-review").submit( function(eventObj) {
            $('<input />').attr('type', 'hidden')
                .attr('name', "rating")
                .attr('value', $("#field-rating").rating("get rating"))
                .appendTo('#form-review');
            return true;
        });
        function changeBigThumbnail(src) {
            $('#big-thumbnail').attr('src', src);
        }
        $(document).ready(function() {
            $('#field-rating').rating({
                maxRating: 5
            });
            $('.ui.star.rating.disable').rating('disable');
        });
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.2';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        window.twttr = (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);

            t._e = [];
            t.ready = function(f) {
                t._e.push(f);
            };

            return t;
        }(document, "script", "twitter-wjs"));
        $('.img-hit').lazy({
            delay: 500,
            enableThrottle: true,
            afterLoad: function() {
                $('div.image').imagefill();
                $('a.image').imagefill();
            }
        });
    </script>
@endsection