<div class="ui vertical stripe quote segment container">
    <div class="ui left aligned grid" id="top-hit">
        <div class="eight wide column">
            <h3>Paling Banyak Diminati</h3>
        </div>
        <div class="right floated right aligned eight wide column">
            <a href="#">Lihat Semua</a>
        </div>
    </div>
    <div class="ui six doubling cards">
        @foreach($topHit as $product)
            <a class="card product" href="{{ url('product/'.$product->id) }}">
                <div class="image" style="height: 170px; width: 170px">
                    @if($product->halal)
                        <div class="ui green left corner label">
                            <img src="{{ asset('images/halal-sign.svg') }}">
                        </div>
                    @endif
                    <img class="img-hit" data-src="{{url("$product->thumbnail")}}">
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
                        <div class="ui mini star rating" data-rating="{{ floor($product->rating) }}"></div>
                        ({{ $product->reviewed }})
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</div>