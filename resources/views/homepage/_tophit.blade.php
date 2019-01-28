<div class="ui vertical stripe quote segment container">
    <div class="ui left aligned grid" id="top-hit">
        <div class="eight wide column">
            <h3>Paling Banyak Diminati</h3>
        </div>
        <div class="right floated right aligned eight wide column">
        </div>
    </div>
    <div class="ui six doubling cards">
        @foreach($topHit as $product)
            <div class="card product">
                <a href="{{ url('product/'.$product->id) }}" class="image" style="height: 170px; width: 170px">
                    @if($product->halal)
                        <div class="ui transparent left corner label">
                            <img src="{{ asset('images/halal-sign.svg') }}">
                        </div>
                    @endif
                    <img class="img-hit" data-src="{{url("$product->thumbnail")}}">
                </a>
                <a href="{{ url('product/'.$product->id) }}" class="content">
                    <div class="header">{{ $product->name }}</div>
                    <span>
                        @if($product->discount)
                            <del style="color: grey">Rp. {{ number_format($product->price, 0, ',', '.') }}</del>&nbsp;
                            <b>Rp. {{ number_format($product->price - ($product->price * $product->discount), 0, ',', '.') }}</b>
                        @else
                            <b>Rp. {{ number_format($product->price, 0, ',', '.') }}</b>
                        @endif
                    </span>
                </a>
                <div class="extra content">
                    <div class="ui heart rating" data-id="{{ $product->id }}" data-rating="{{ session()->exists('rated') ? in_array($product->id, session('rated')) : 0 }}" data-max-rating="1"></div>
                    <span id="{{$product->id}}">{{ $product->liked }}</span>
                    <span class="right floated">
                        <a href="{{ !Auth::user() ? url('login') : url('product/'.$product->id) }}#top" class="ui mini star rating" data-rating="{{ floor($product->rating) }}"></a>
                        ({{ $product->reviewed }})
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>