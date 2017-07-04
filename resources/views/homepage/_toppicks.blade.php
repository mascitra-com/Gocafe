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
                <a href="{{ url('shop/'.$recommend->slug) }}" class="image" style="width: 230px; height: 270px">
                    <img class="logo-pick" data-src="{{ $recommend->logo }}" height="400px">
                </a>
                <div class="content">
                    <div class="ui five column grid">
                        @foreach($recommend->latestMenu as $product)
                            <a class="column" href="{{ url('product/'.$product->id) }}">
                                <div class="ui fluid card">
                                    <div class="image" style="width: 149px; height: 120px">
                                        <img class="img-pick" data-src="{{ url("$product->thumbnail") }}">
                                    </div>
                                    <div class="content">
                                        <div class="header">{{ $product->name }}</div>
                                        <span>
                                            @if($product->discount)
                                                <del style="color: grey" class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</del>&nbsp;
                                                <b class="price">Rp. {{ number_format($product->price - ($product->price * $product->discount), 0, ',', '.') }}</b>
                                            @else
                                                <b class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</b>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="extra content">
                                        <div class="ui mini heart rating" data-rating="0" data-max-rating="1"></div> {{ $product->liked }}
                                        <span class="right floated">
                                            <div class="ui mini star rating" data-rating="{{ floor($product->rating) }}"></div>
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