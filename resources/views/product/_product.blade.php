<div class="card product">
    <a href="{{ url('product/'.$product->id) }}" class="image" style="width: 208px; height: 200px">
        @if($product->halal)
            <div class="ui transparent left corner label">
                <img src="{{ asset('images/halal-sign.svg') }}">
            </div>
        @endif
        <img src="{{url("$product->thumbnail")}}">
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
        <div class="ui heart rating" data-rating="0" data-max-rating="1"></div> {{ $product->liked }}
        <span class="right floated">
            <div class="ui tiny star rating" data-rating="{{ floor($product->rating) }}"></div>
            ({{ $product->reviewed }})
        </span>
    </div>
</div>