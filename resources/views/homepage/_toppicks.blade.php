<div class="ui vertical segment container">
    <div class="ui text">
        <div class="ui left aligned grid" id="top-picks">
            <div class="eight wide column">
                <h3>Jelang Ramadhan, Berbuka dan Sahur, Kulinerae!</h3>
            </div>
            <div class="right floated right aligned eight wide column">
                <a href="{{ url('recommended-shop') }}">Lihat Semua</a>
            </div>
        </div>
        @foreach($recommended as $recommend)
            <div class="ui card stack fluid">
                <div class="image">
                    <img src="{{ "https://dummyimage.com/250x250/8C4728/fff.jpg&text=" . str_replace(' ', '+', $recommend->name) }}">
                </div>
                <div class="content">
                    <div class="ui four column grid">
                        @foreach($recommend->latestMenu as $menu)
                            <a class="column" href="{{ url('product/'.$menu->id) }}">
                                <div class="ui fluid card">
                                    <div class="image">
                                        <img src="{{ url('menus/showThumbnail/'.$menu->id) }}">
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