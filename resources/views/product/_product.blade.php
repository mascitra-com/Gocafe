<a class="card product" href="{{ url('product/'.$product->id) }}">
    <div class="image">
        <img src="{{url("menus/showThumbnail/$product->id")}}">
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
</a>