@extends('_layout.homepage.index')
@section('page_title', 'Homepage')
@section('content')
    {{--Promo & Visitor Favorite--}}
    @include('homepage._promotion')
    {{--Recommended Cafe / Restaurant--}}
    @include('homepage._recommended')
    {{--Top Picks with Their Products--}}
    @include('homepage._toppicks')
    {{--Top Hit--}}
    @include('homepage._tophit')
    {{--Hot List--}}
    @include('homepage._hotlist')
    {{--Slogan--}}
    <div class="ui vertical stripe quote segment container">
    <div class="ui equal width grid">
        @for($i=0;$i<3;$i++)
        <div class="column">
            <img class="ui tiny left floated image" src="https://dummyimage.com/150x150/8C4728/fff.jpg&text=Image" >
            Odio optio perferendis quisquam, quo reprehenderit, ut? Consectetur itaque vero voluptates?
        </div>
        @endfor
    </div>
    </div>
    <div class="ui vertical segment container">
        <div class="ui attached message grid">
            <div class="eight wide column">
                <div class="header">
                    Selamat Datang di Kulinerae
                </div>
                <p>Daftarkan alamat e-mail anda untuk mendapatkan info & deal menarik dari Kulinerae</p>
            </div>
            <div class="eight wide column">
                <form class="ui large form">
                    <div class="inline fields">
                        <div class="twelve wide field">
                            <input type="text" placeholder="Alamat Email">
                        </div>
                        <div class="field">
                            <div class="ui large brown button">Daftar</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script>
        $(document).ready(function() {
            $('.ui.rating').rating({
                maxRating: 5
            }).rating('disable');
            $('.menu .item').tab();
            // fix menu when passed
            $('.masthead')
                .visibility({
                    once: false,
                    onBottomPassed: function() {
                        $('.fixed.menu').transition('fade in');
                    },
                    onBottomPassedReverse: function() {
                        $('.fixed.menu').transition('fade out');
                    }
                });
            // create sidebar and attach to menu open
            $('.ui.sidebar').sidebar('attach events', '.toc.item');
        });
    </script>
@endsection