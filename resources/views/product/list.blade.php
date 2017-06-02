@extends('_layout.homepage.index')
@section('page_title', 'Daftar Produk')

@section('content')
    <div class="ui grid container">
        {{-- Side Content --}}
        <div class="four wide column">
            <div class="ui brown segment">
                <h5>Kategori</h5>
                <div class="ui link list">
                    @foreach($categories as $category)
                        <a class="item" href="#">{{ $category->name }}</a>
                    @endforeach
                </div>
                <h5>Urutkan</h5>
                <div class="ui selection dropdown fluid" id="order-by">
                    <input type="hidden" name="order-by" value="{{ isset($filter['orderBy']) ? $filter['orderBy'] : '0' }}">
                    <i class="dropdown icon"></i>
                    <div class="text">Paling Sesuai</div>
                    <div class="menu">
                        <div class="item" data-value="0">Paling Sesuai</div>
                        <div class="item" data-value="1">Ulasan</div>
                        <div class="item" data-value="2">Rating</div>
                        <div class="item" data-value="3">Termurah</div>
                        <div class="item" data-value="4">Termahal</div>
                        <div class="item" data-value="5">Terbaru</div>
                    </div>
                </div>
                <h5>Lokasi</h5>
                <div class="ui search selection dropdown fluid" id="search-location">
                    <input type="hidden" name="location">
                    <i class="dropdown icon"></i>
                    <div class="text">Pilih Lokasi</div>
                    <div class="menu" id="provinceListForSearch"></div>
                </div>
                <h5>Harga</h5>
                <div class="ui internally grid">
                    <div class="row">
                        <div class="seven wide column">
                            <div class="ui small labeled input fluid">
                                <div class="ui label" style="font-size: 9pt">Rp</div>
                                <input type="text" placeholder="Min" style="font-size: 9pt" class="price" name="lowPrice"
                                       value="{{ isset($filter['lowPrice']) ? $filter['lowPrice'] : '' }}" id="lowPrice">
                            </div>
                        </div>
                        <div class="one wide column">
                            <span style="font-size: 9pt" >Ke</span>
                        </div>
                        <div class="seven wide column">
                            <div class="ui small labeled input fluid">
                                <div class="ui label" style="font-size: 9pt">Rp</div>
                                <input type="text" placeholder="Max" style="font-size: 9pt" class="price" name="highPrice"
                                value="{{ isset($filter['highPrice']) ? $filter['highPrice'] : '' }}" id="highPrice">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Main Content --}}
        <div class="twelve wide column grid">
            <div class="mini ui buttons">
                <button class="ui brown button active" id="searchProduct"><i class="fa fa-coffee"></i> Produk</button>
                <button class="ui brown basic button" id="searchShop"><i class="fa fa-map-marker"></i> Nama Tempat</button>
            </div>
            <div class="ui divider"></div>
            <div class="ui message">
                <p>Hasil Pencarian Produk "{{ ucfirst($filter['query']) }}" ({{ count($productList) }} produk)</p>
            </div>
            <div class="ui four doubling cards">
                @foreach($productList as $product)
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
            <div class="ui divider"></div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="{{ url('plugins/jquery/jquery.number.min.js') }}"></script>
    <script src="{{ asset('js/product.js') }}"></script>
@endsection