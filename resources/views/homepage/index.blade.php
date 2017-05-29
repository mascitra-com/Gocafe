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
    {{--Category List--}}
    @include('homepage._categorylist')
    {{--Lokasi List--}}
    @include('homepage._locationlist')
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