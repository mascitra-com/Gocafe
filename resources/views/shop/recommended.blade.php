@extends('_layout.homepage.index')
@section('content')
    <div class="ui vertical segment container" id="shop-list">
        <div class="ui text">
            <div class="ui left aligned grid" id="top-picks">
                <div class="eight wide column">
                    <h3>Jelang Ramadhan, Berbuka dan Sahur, Kulinerae!</h3>
                </div>
                <div class="right floated right aligned eight wide column">
                    <a href="#">Lihat Semua</a>
                </div>
            </div>
            <div id="list">
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
                <div class="ui large centered inline text loader">
                    Adding more content...
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script>
        var hostname = window.location.hostname;
        var offset = {{ count($recommended) }};
        $('#shop-list')
            .visibility({
                once       : false,
                observeChanges: true,
                offset: 1000,
                onBottomPassed  : function() {
                    loadMore();
                }
            });

        function loadMore() {
            $.ajax({
                url: "https://"+ hostname + '/load-recommended/' + offset,
                dataType: 'json',
                success: function (response) {
                    $.each(response.recommended, function (i, recommended) {
                        var name = recommended.name;
                        var products = "";
                        console.log(recommended);
                        $.each(recommended.latest_menu, function (i, menu) {
                            console.log(menu.id);
                            products += "<div class='column'><div class='ui fluid card'><a class='image'><img src='" + getThumbnail(menu.id) + "'></a></div></div>";
                        });
                        var markup = "<div class='ui card stack fluid'><div class='image'><img src='https://dummyimage.com/250x250/8C4728/fff.jpg&text=" + name + "'></div><div class='content'><div class='ui four column grid'>" + products + "</div></div></div>";
                        $('#list').append(markup);
                        offset += {{ count($recommended) }};
                    });
                }
            });
        }

        function getThumbnail(idMenu) {
            return "https://" + hostname + "/menus/showThumbnail/" + idMenu;
        }
    </script>
@endsection