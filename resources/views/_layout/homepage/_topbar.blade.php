
<!-- Following Menu -->
<div class="ui large top fixed hidden menu" id="top-bar">
    <a class="item" href="{{ url('/') }}" style="width: 125px">
        <img src="{{ asset('images/logoname.png') }}" alt="Kulinerae" class="ui site-logo">
    </a>
    <div class="ui pointing dropdown link" id="category-btn">
        <a class="category item">
            Kategori
            <i class="ui floating dropdown icon"></i>
        </a>
    </div>
    <div class="ui item" style="width: 60%">
        <form action="{{ url('search') }}" class="ui action input" method="GET" id="search">
            <input type="text" name="query" placeholder="Cari Produk atau Cafe..." value="{{ empty($filter['query']) ? '' :  $filter['query']}}" id="query">
            <div class="ui search selection dropdown" id="location" style="border-left: none">
                <input type="hidden" name="city" value="{{ isset($city) ? $city->id : '' }}">
                <i class="dropdown icon"></i>
                <div class="text">{{ isset($city) ? $city->name : 'Semua Lokasi' }}</div>
                <div class="menu" id="provinceList"></div>
            </div>
            <input type="hidden" name="province" value="{{ isset($province) ? $province->id : '' }}">
            <button class="ui brown button" type="submit">Cari</button>
        </form>
        <div class="results"></div>
    </div>
    <div class="right menu">
        @if(Auth::check())
            <a href="{{ url('dashboard') }}" class="item">Dashboard</a>
            <span style="margin-right: 6.5em"></a>
                @else
                    <a href="{{ url('register') }}" class="item">Daftar</a>
                    <a href="{{ url('login') }}" class="item">Masuk</a>
                    <span style="margin-right: 7.5em"></a>
        @endif
    </div>
</div>
<div id="category-menu">
    {{--.ui.grid>(.two.wide.column>.ui.fluid.card)*10--}}
    <h2>Kategori Menu</h2>
    <div class="ui grid">
        @php
            $categories_menu = array('aneka-ayam', 'aneka-bebek', 'aneka-nasi', 'bakmi', 'bakso',
                                'burger', 'sandwich',  'chinese', 'coffee-shop',
                                'fast-food', 'indian', 'italian', 'japanese',
                                'korea', 'martabak', 'middle-eastern', 'minuman',
                                'oleh-oleh', 'pizza', 'pasta', 'roti', 'sate', 'seafood',
                                'snack', 'jajanan', 'soto', 'soup', 'steak', 'sweet-dessert',
                                'thailand', 'western');
        @endphp
        @foreach($categories_menu as $category)
            <div class="two wide column">
                <a href="#">
                    <div class="ui fluid card card-category" data-gambar="{{ asset("images/category-bg/{$category}.png") }}">
                        <b>{{ ucwords(str_replace('-', ' ', $category)) }}</b>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <h2>Berdasarkan Pulau</h2>
    <div class="ui grid">
        @php
        $provinces = array('jawa', 'kalimantan', 'maluku', 'nusa-tenggara', 'papua', 'sulawesi', 'sumatera');
        @endphp
        @foreach($provinces as $province)
            <div class="two wide column">
                <a href="#">
                    <div class="ui fluid card card-island" data-gambar="{{ asset("images/island-icon/{$province}.png") }}">
                        <b>{{ ucwords(str_replace('-', ' ', $province)) }}</b>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>