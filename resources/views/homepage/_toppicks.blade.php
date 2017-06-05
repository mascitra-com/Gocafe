<div class="ui vertical segment container">
    <div class="ui text">
        <div class="ui left aligned grid" id="top-picks">
            <div class="eight wide column">
                <h3>Jelang Ramadhan, Berbuka dan Sahur, Kulinerae!</h3>
            </div>
            <div class="right floated right aligned eight wide column">
                <a href="#">Lihat Semua</a>
            </div>
        </div>
        @foreach($recommended as $recommend)
            <div class="ui card stack fluid">
                <div class="image" style="width: 300px; height: 330px">
                    <img src="{{ url('logo/'.$recommend->id) }}" height="400px">
                </div>
                <div class="content">
                    <div class="ui four column grid">
                        @foreach($recommend->latestMenu as $product)
                            <a class="column" href="{{ url('product/'.$product->id) }}">
                                <div class="ui fluid card">
                                    <div class="image" style="width: 175px; height: 175px">
                                        <img src="{{ url('menus/showThumbnail/'.$product->id) }}">
                                    </div>
                                    <div class="content">
                                        <div class="header">{{ $product->name }}</div>
                                        <span>
                                            @if($product->discount)
                                                <del style="color: grey">Rp. {{ number_format($product->price, 0, ',', '.') }}</del>&nbsp;
                                                <b>Rp. {{ number_format($product->price - ($product->price * $product->discount), 0, ',', '.') }}</b>
                                            @else
                                                <b>Rp. {{ number_format($product->price, 0, ',', '.') }}</b>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="extra content">
                                        <div class="ui heart rating" data-rating="0" data-max-rating="1"></div> {{ $product->liked }}
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