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
        <div class="ui heart rating" data-id="{{ $product->id }}" data-rating="{{ session()->exists('rated') ? in_array($product->id, session('rated')) : 0 }}" data-max-rating="1"></div>
        <span id="{{$product->id}}">{{ $product->liked }}</span>
        <span class="right floated">
            <a href="{{ !Auth::user() ? url('login') : url('product/'.$product->id) }}#top" class="ui tiny star rating" data-rating="{{ floor($product->rating) }}"></a>
            ({{ $product->reviewed }})
        </span>
    </div>
</div>