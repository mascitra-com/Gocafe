@extends('_layout.homepage.index')
@section('page_title', $product->name)
@section('content')
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
            <div class="ui segment">
                <div class="ui grid">
                    <div class="row">
                        <div class="six wide column">
                            <img src="{{ url('/menus/showThumbnail/'.$product->id) }}" id="big-thumbnail" class="ui fluid image">
                        </div>
                        <div class="ten wide column">
                            <div class="ui buttons brown">
                                <a class="ui button active" data-tab="first">Informasi Produk</a>
                                <a class="ui button" data-tab="second">Ulasan Produk</a>
                            </div>
                            <br>
                            <h4>Deskripsi Produk</h4>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <h4>&nbsp;&nbsp;<i class="fa fa-list"></i> Ringkasan Ulasan 3 Bulan Terakhir</h4>
                            <table class="ui table" id="table-review">
                                <tbody>
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td width='15%'><img src='/images/blank-avatar.png' alt='' class='ui tiny circular image'></td>
                                            <td>
                                                <p><div class='ui rating' data-rating='{{ $review->rating }}'></div></p>
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
                <h2 style="color: #8C4728">Rp. {{ number_format($product->price, 0, ',', '.') }},-</h2>
                <p class="price-last-update">Perubahan Harga Terakhir: {{ date('d-m-Y, H:i') }}</p>
            </div>
            <button class="ui fluid button"><i class="fa fa-heart"></i> &nbsp Tambah ke Wishlist</button>
            <div class="ui center aligned segment container">
                <a href="{{ url('shop/' . $cafe->id) }}">
                <h3 style="color: #8C4728">{{ $cafe->name }}</h3>
                <img class="ui centered tiny image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlHfIvsQ2CtsjxMC-GVIJFu7ab5I9GTdsMS5pelqZCFfvAYortrg"><br>
                </a>
                <a target="_blank" href="https://www.facebook.com/{{ $cafe->facebook }}"><i class="fa fa-facebook-square"></i> {{ $cafe->facebook }}</a><br>
                <a target="_blank" href="https://www.twitter.com/{{ $cafe->twitter }}"><i class="fa fa-twitter-square"></i> {{ $cafe->twitter }}</a><br>
                <a target="_blank" href="https://www.instagram.com/{{ $cafe->instagram }}"><i class="fa fa-instagram"></i> {{ $cafe->instagram }}</a><br>
                <span style="color: #F18803"><i class="fa fa-phone-square"></i> {{ $cafe->phone }}</span><br><br>
                <button class="ui brown fluid button"><i class="fa fa-plus"></i> &nbsp Favoritkan</button><br>
                <button class="ui fluid button"><i class="fa fa-envelope"></i> &nbsp Kirim Pesan</button>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script>
        $(document).ready(function() {
            $('.ui.rating').rating({
                maxRating: 5
            }).rating('disable');
        });
    </script>
@endsection