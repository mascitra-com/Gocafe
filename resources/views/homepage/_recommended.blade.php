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
            <a class="card" href="{{ url('shop/'.$cafe->id) }}">
                <div class="image">
                    <img src="{{ "https://dummyimage.com/250x250/8C4728/fff.jpg&text=" . str_replace(' ', '+', $cafe->name) }}">
                </div>
                <div class="content center aligned">
                    <div class="header">{{ $cafe->name }}</div>
                </div>
            </a>
        @endforeach
    </div>
</div>