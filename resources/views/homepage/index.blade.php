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
    {{--@include('homepage._hotlist')--}}
    {{--Slogan--}}
    <div class="ui vertical quote segment container" style="padding: 5em 0em">
        <div class="ui center aligned grid container">
            <div class="column">
                <h3 class="ui header">
                    Mau Kafe / Rumah Makan Kamu di Kenal Banyak Orang? Daftarkan Segera di Kulinerae
                </h3>
                <form class="ui form" method="get" action="{{ url('register') }}">
                    <button type="submit" value="Subscribe" class="ui huge brown submit button">
                        Daftar
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="ui vertical quote segment container">
        <div class="ui equal width grid">
            <div class="column">
                <img class="ui left floated image" src="{{ asset('images/mudah1.png') }}" height="100px">
                Bersama Kulinerae Anda pencinta kuliner dapat dengan mudah menemukan cafe dan restoran favorit dilokasimu
            </div>
            <div class="column">
                <img class="ui left floated image" src="{{ asset('images/lengkap1.png') }}" height="100px">
                Temukan ragam kuliner nusantara hingga kuliner dunia paling lengkap dengan katalog kami
            </div>
            <div class="column">
                <img class="ui left floated image" src="{{ asset('images/gratis1.png') }}" height="100px">
                Buka dan kelola gerai online Anda secara mudah ,nyaman dan gratis
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/image-slider/ads.css') }}">
@endsection
@section('javascripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js"></script>
    <script src="{{ asset('plugins/imagefill/js/jquery-imagefill.js') }}"></script>
    <script>
        $('div.image').imagefill();
        $('a.image').imagefill();
        $(document).ready(function() {
            var jssor_ads_options = {
                $AutoPlay: 1,
                $Idle: 3000,
                $SlideEasing: $Jease$.$InOutSine,
                $LazyLoading: 1,
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$
                }
            };

            var jssor_ads_slider = new $JssorSlider$("jssor_ads", jssor_ads_options);

            /*#region responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_ads_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 700);
                    jssor_ads_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*#endregion responsive code end*/

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