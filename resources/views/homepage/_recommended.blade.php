<div class="ui vertical stripe quote segment container">
    <div class="ui left aligned grid" id="recommended">
        <div class="eight wide column">
            <h3>Rekomendasi Toko</h3>
        </div>
        <div class="right floated right aligned eight wide column">
            <a href="{{ url('recommended-shop') }}">Lihat Semua</a>
        </div>
    </div>
    <div class="ui eight doubling cards">
        @foreach($cafes as $cafe)
            <a class="card" href="{{ url('shop/'.$cafe->slug) }}">
                <div class="image" style="height: 131px; width: 131px">
                    <img src="{{ $cafe->logo }}">
                </div>
                <div class="content center aligned">
                    <div class="header">{{ $cafe->name }}</div>
                </div>
            </a>
        @endforeach
    </div>
</div>