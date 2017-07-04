@extends('_layout.homepage.index')
@section('page_title', $product->name)
@section('content')
    <div class="ui breadcrumb container grid">
        <div class="twelve wide column">
        <a class="section" href="{{ url('/') }}">Home</a>
        <i class="right angle icon divider"></i>
        <a class="section" href="{{ url('shop/'.$shop->slug) }}">{{ $shop->name }}</a>
        <i class="right angle icon divider"></i>
        <div class="active section">{{ $product->name }}</div>
        </div>
    </div>
    <div class="ui grid container">
        {{-- Main Content --}}
        <div class="twelve wide column">
            <h1 style="color: #8C4728">
                {{ $product->name }}<br>
                <small style="color: #F18803">{{ $product->category->name }}</small>
            </h1>
            <div class="ui segment">
                Bagikan :
                <button class="ui facebook button">
                    <i class="facebook icon"></i>
                    Facebook
                </button>
                <button class="ui twitter button">
                    <i class="twitter icon"></i>
                    Twitter
                </button>
                <button class="ui google plus button">
                    <i class="google plus icon"></i>
                    Google Plus
                </button>
            </div>
            <div class="ui segment" style="margin-bottom: 1em">
                <div class="ui grid">
                    <div class="row">
                        <div class="six wide column">
                            <div class="row">
                                <div class="column">
                                    <div class="ui fluid image" style="height: 285px; width: 285px">
                                        @if($product->halal)
                                            <div class="ui green left corner label">
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
                                            <td width='15%'><img src='/images/blank-avatar.png' alt='' class='ui tiny circular image'></td>
                                            <td>
                                                <p><div class='ui star rating disable' data-rating='{{ $review->rating }}'></div></p>
                                                <p>{{ $review->review }}</p>
                                                <p><span class='label label-default'>{{ date('d-m-Y', strtotime($review->created_at)) }}</span></p>
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
                <a href="{{ url('shop/' . $shop->id) }}">
                <h3 style="color: #8C4728">{{ $shop->name }}</h3>
                <img class="ui centered tiny image" src="{{ url($shop->logo) }}"><br>
                </a>
                <a target="_blank" href="https://www.facebook.com/{{ $shop->facebook }}"><i class="fa fa-facebook-square"></i> {{ $shop->facebook }}</a><br>
                <a target="_blank" href="https://www.twitter.com/{{ $shop->twitter }}"><i class="fa fa-twitter-square"></i> {{ $shop->twitter }}</a><br>
                <a target="_blank" href="https://www.instagram.com/{{ $shop->instagram }}"><i class="fa fa-instagram"></i> {{ $shop->instagram }}</a><br>
                <span style="color: #F18803"><i class="fa fa-phone-square"></i> {{ $shop->phone }}</span><br><br>
                <button class="ui brown fluid button"><i class="fa fa-plus"></i> &nbsp Favoritkan</button><br>
                <button class="ui fluid button"><i class="fa fa-envelope"></i> &nbsp Kirim Pesan</button>
            </div>
        </div>
    </div>
    @include('homepage._tophit')
@endsection

@section('javascripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js"></script>
    <script src="{{ asset('plugins/imagefill/js/jquery-imagefill.js') }}"></script>
    <script>
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