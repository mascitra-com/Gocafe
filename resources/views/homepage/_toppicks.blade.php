<div class="ui vertical segment container">
    <div class="ui text">
        <div class="ui left aligned grid" id="top-picks">
            <div class="eight wide column">
                <h3>Kuliner Pilihan!</h3>
            </div>
            <div class="right floated right aligned eight wide column">
                <a href="{{ url('recommended-shop') }}">Lihat Semua</a>
            </div>
        </div>
        @foreach($recommended as $recommend)
            <div class="ui card stack fluid">
                <a href="{{ url('shop/'.$recommend->slug) }}" class="image" style="width: 230px; height: 300px">
                    <img class="logo-pick" data-src="{{ $recommend->logo }}" height="400px">
                </a>
                <div class="content">
                    <div class="ui five column grid">
                        @foreach($recommend->latestMenu as $product)
                            <div class="column">
                                <div class="ui fluid card">
                                    <a href="{{ url('product/'.$product->id) }}" class="image" style="width: 149px; height: 149px">
                                        @if($product->halal)
                                            <div class="ui transparent left corner label">
                                                <img src="{{ asset('images/halal-sign.svg') }}" class="halal-sign">
                                            </div>
                                        @endif
                                        <img class="img-pick" data-src="{{ url("$product->thumbnail") }}">
                                    </a>
                                    <a href="{{ url('product/'.$product->id) }}" class="content">
                                        <div class="header">{{ $product->name }}</div>
                                        <span>
                                            @if($product->discount)
                                                <del style="color: grey" class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</del>&nbsp;
                                                <b class="price">Rp. {{ number_format($product->price - ($product->price * $product->discount), 0, ',', '.') }}</b>
                                            @else
                                                <b class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</b>
                                            @endif
                                        </span>
                                    </a>
                                    <div class="extra content">
                                        <div class="ui mini heart rating" data-id="{{ $product->id }}" data-rating="{{ session()->exists('rated') ? in_array($product->id, session('rated')) : 0 }}" data-max-rating="1"></div>
                                        <span id="{{$product->id}}">{{ $product->liked }}</span>
                                        <span class="right floated">
                                            <a href="{{ !Auth::user() ? url('login') : url('product/'.$product->id) }}#top" class="ui mini star rating" data-rating="{{ floor($product->rating) }}"></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>