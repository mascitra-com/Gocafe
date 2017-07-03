@extends('_layout.homepage.index')
@section('page_title', 'Daftar Produk')
@section('content')
    <div class="ui grid container">
        {{-- Main Content --}}
        <div class="sixteen wide column grid">
            <div class="mini ui buttons">
                <button class="ui brown basic button" id="searchProduct"><i class="fa fa-coffee"></i> Produk</button>
                <button class="ui brown button active" id="searchShop"><i class="fa fa-map-marker"></i> Nama Tempat</button>
            </div>
            <div class="ui divider"></div>
            <div class="ui message">
                <p>Hasil Pencarian Toko "{{ ucfirst($filter['query']) }}" ({{ count($shopList) }} produk)</p>
            </div>
            <div class="ui eight doubling cards">
                @foreach($shopList as $shop)
                    <a class="card product" href="{{ url('product/'.$shop->id) }}">
                        <div class="image">
                            <img src="{{url($shop->logo)}}">
                        </div>
                        <div class="content">
                            <div class="header">{{ $shop->name }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="ui divider"></div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script>
        document.getElementById("searchProduct").addEventListener("click", function () {
            $('#search').attr('action', '/search');
            document.getElementById("search").submit();
        });

        $("#search").on("submit", function () {
            $(this).attr("action", "/search/shop");
        });
    </script>
@endsection