<div class="ui vertical stripe quote segment container">
    <div class="ui left aligned grid" id="hot-list">
        <div class="eight wide column">
            <h3>Trending</h3>
        </div>
        <div class="right floated right aligned eight wide column">
            <a href="#">Lihat Semua</a>
        </div>
    </div>
    <div class="ui five doubling cards">
        @foreach($favProducts as $product)
            <div class="card">
                <a class="image" href="#">
                    <img src="{{ url('menus/showThumbnail/'.$product->item_id) }}">
                </a>
                <div class="content">
                    <a class="header">{{ $product->name }}</a>
                    <div class="meta">
                        <i class="home icon"></i>
                        {{ rand(153, 323) }}x dipesan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>