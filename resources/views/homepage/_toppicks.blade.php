<div class="ui vertical segment container">
    <div class="ui text">
        <div class="ui left aligned grid" id="top-picks">
            <div class="eight wide column">
                <h3>Jelang Ramadhan, Berbuka dan Sahur, Kulinerae!</h3>
            </div>
            <div class="right floated right aligned eight wide column">
                <a href="{{ url('recommended-shop') }}">Lihat Semua</a>
            </div>
        </div>
        @foreach($recommended as $recommend)
            <div class="ui card stack fluid">
                <div class="image" style="width: 300px; height: 300px">
                    <img src="{{ url('logo/'.$recommend->id) }}" height="400px">
                </div>
                <div class="content">
                    <div class="ui four column grid">
                        @foreach($recommend->latestMenu as $product)
                            <a class="column" href="{{ url('product/'.$product->id) }}">
                                <div class="ui fluid card">
                                    <div class="image" style="width: 175px; height: 150px">
                                        <img src="{{ url('menus/showThumbnail/'.$product->id) }}">
                                    </div>
                                    <div class="content">
                                        <div class="header">{{ $product->name }}</div>
                                        <span>
                                            <b>Rp. {{ number_format($product->price, 0, ',', '.') }}</b>
                                        </span>
                                    </div>
                                    <div class="extra content">
                                        <i class="fa fa-heart"></i> {{ $product->liked }}
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
    </div>
</div>