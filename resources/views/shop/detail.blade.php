@extends('_layout.homepage.index')
@section('page_title', $cafe->name)
@section('content')
    <div class="ui vertical segment container">
        <div class="row">
            <img class="ui image fluid" src="http://www.giftstokolkata.com/image/restaurant-banner.jpg" alt="Image">
        </div>
    </div>
    <div class="ui vertical segment container">
        <div class="ui two column divided grid">
            <div class="row">
                <div class="six column">
                    <div class="ui grid">
                        <div class="four wide column">
                            <img class="ui small image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlHfIvsQ2CtsjxMC-GVIJFu7ab5I9GTdsMS5pelqZCFfvAYortrg">
                        </div>
                        <div class="twelve wide column">
                            <h3>{{ $cafe->name }}</h3>
                            <p>{{ $cafe->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="six column">
                    <table class="ui celled table">
                        <thead>
                        <th>Nama Cabang</th>
                        <th>Lokasi</th>
                        <th>Alamat</th>
                        <th>Jam Buka</th>
                        <th>Jam Tutup</th>
                        </thead>
                        <tbody>
                        @foreach($branches as $branch)
                            <tr>
                                <td>Cabang {{ $branch->location->name }}</td>
                                <td>
                                    {{ isset($branch->location->city) ? $branch->location->city->name. ',' : '' }}
                                    {{ isset($branch->location->province) ? $branch->location->province->name: '' }}
                                </td>
                                <td>{{ $branch->address }}</td>
                                <td>{{ $branch->open_hours }}</td>
                                <td>{{ $branch->close_hours }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="ui vertical segment container">
        <div class="ui grid">
            <div class="three wide column">
                <h3>Kategori</h3>
                <div class="ui secondary vertical menu">
                    @foreach($categories as $category)
                        <a class="brown item" data-id="{{ $category->id }}">
                            {{ $category->name }}
                            {{--<div class="ui brown left label">21</div>--}}
                        </a>
                    @endforeach
                </div>
                <h3>Informasi</h3>
                <div class="ui secondary vertical menu">
                    <a class="item">
                        Tentang Kami
                    </a>
                    <a class="item">
                    Syarat & Ketentuan
                    </a>
                    <a class="item">
                        Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="thirteen wide column" style="padding-left: 2em">
                <h3>Produk</h3>
                <div class="ui three doubling cards" id="productList">
                    @foreach($products as $product)
                        <a class="card product" href="{{ url('product/'.$product->id) }}">
                            <div class="image">
                                <img src="{{url("menus/showThumbnail/$product->id")}}">
                            </div>
                            <div class="content">
                                <div class="header">{{ $product->name }}</div>
                            </div>
                            <div class="extra content">
                                <span>
                                <i class="money brown icon"></i>
                                <b>Rp. {{ number_format($product->price, 0, ',', '.') }}</b>
                                </span>
                                <span class="right floated">
                                    <div class="ui star rating right floated" data-rating="{{ floor($product->rating) }}"></div>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="{{ url('plugins/jquery/jquery.number.min.js') }}"></script>
    <script src="{{ url('js/shop.js') }}"></script>
@endsection