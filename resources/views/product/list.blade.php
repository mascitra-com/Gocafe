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
                    <input type="hidden" name="order-by" value="{{ isset($filter['orderBy']) ? $filter['orderBy'] : '' }}">
                    <i class="dropdown icon"></i>
                    <div class="text">Paling Sesuai</div>
                    <div class="menu">
                        <div class="item" data-value="">Paling Sesuai</div>
                        <div class="item" data-value="1">Ulasan</div>
                        <div class="item" data-value="2">Rating</div>
                        <div class="item" data-value="3">Termurah</div>
                        <div class="item" data-value="4">Termahal</div>
                        <div class="item" data-value="5">Terbaru</div>
                    </div>
                </div>
                <h5>Lokasi</h5>
                <div class="ui search selection dropdown fluid" id="search-by-province">
                    <input type="hidden" name="province" id="add-search-province" value="{{ (isset($province)) ? $province->id : (isset($city) ? $city->province->id : '')}}">
                    <i class="dropdown icon"></i>
                    <div class="text">{{ (isset($province)) ? $province->name : (isset($city) ? $city->province->name : 'Semua Lokasi') }}</div>
                    <div class="menu" id="provinceListForSearch"></div>
                </div>
                <br>
                <div class="ui search selection dropdown fluid" id="search-by-city">
                    <input type="hidden" name="city" id="add-search-city" value="{{ isset($city) ? $city->id : '' }}">
                    <i class="dropdown icon"></i>
                    <div class="text">{{ isset($city) ? $city->name : 'Semua Lokasi' }}</div>
                    <div class="menu" id="cityListForSearch"></div>
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
                    <div class="card product">
                        <a href="{{ url('product/'.$product->id) }}" class="image">
                            @if($product->halal)
                                <div class="ui transparent left corner label">
                                    <img src="{{ asset('images/halal-sign.svg') }}">
                                </div>
                            @endif
                            <img src="{{url($product->thumbnail)}}">
                        </a>
                        <a href="{{ url('product/'.$product->id) }}" class="content">
                            <div class="header">
                                {{ $product->name }} <br>
                                <small style="color: #F18803">{{ $product->cafe_name }}</small>
                            </div>
                        </a>
                        <div class="extra content">
                            <div class="ui heart rating" data-rating="0" data-max-rating="1"></div> {{ $product->liked }}
                            <span class="right floated">
                                <div class="ui star rating right floated" data-max-rating="5" data-rating="{{ floor($product->rating) }}"></div>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="ui divider"></div>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .ui.label>img {
            margin-top: 5px !important;
            margin-left: -5px !important;
        }
        .ui.transparent.left.corner.label {
            border-color: transparent;
        }
    </style>
@endsection
@section('javascripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.min.js"></script>
    <script src="{{ asset('js/product.js') }}"></script>
@endsection