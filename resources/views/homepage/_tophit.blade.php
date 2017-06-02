<div class="ui vertical stripe quote segment container">
    <div class="ui left aligned grid" id="recommended">
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
                <div class="image" style="height: 200px; width: 170px">
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
                        <div class="ui mini star rating" data-rating="{{ floor($product->rating) }}"></div>
                        ({{ $product->reviewed }})
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</div>