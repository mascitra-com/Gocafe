<!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+6281230033880", // WhatsApp number
            call_to_action: "Kulinerae Online", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->
@extends('_layout.homepage.index')
@section('page_title', 'Homepage')
@section('content')
    {{--Promo & Visitor Favorite--}}
    @include('homepage._top')
    {{--Recommended Cafe / Restaurant--}}
    @include('homepage._recommended')
    {{--Top Picks with Their Products--}}
    @include('homepage._toppicks')
    {{--Top Hit--}}
    @include('homepage._tophit')
    {{--Category--}}
    @include('homepage._category')
    {{--Location--}}
    @include('homepage._location')
    {{--Hot List--}}
    {{--@include('homepage._hotlist')--}}
    {{--Slogan--}}
    <div class="ui vertical quote segment container" style="padding: 5em 0em">
        <div class="ui grid container">
            <div class="ten wide column" style="padding-left: 5em; padding-top: 4em">
                <h2 class="ui header">
                    Mau Kafe / Rumah Makan Kamu di Kenal Banyak Orang? Daftarkan Segera di Kulinerae
                </h2>
                <form class="ui form" method="get" action="{{ url('register') }}">
                    <button type="submit" value="Subscribe" class="ui huge brown submit button">
                        Daftar
                    </button>
                </form>
            </div>
            <div class="six wide column">
                <img class="ui image" src="{{ asset('images/join.jpg') }}" alt="Join" style="height: 200px; width: auto">
            </div>
        </div>
    </div>
    <div class="ui vertical quote segment container">
        <div class="ui equal width grid">
            <div class="column">
                <img class="ui left floated image" data-src="{{ asset('images/mudah1.png') }}" height="100px">
                Bersama Kulinerae Anda pencinta kuliner dapat dengan mudah menemukan cafe dan restoran favorit dilokasimu
            </div>
            <div class="column">
                <img class="ui left floated image" data-src="{{ asset('images/lengkap1.png') }}" height="100px">
                Temukan ragam kuliner nusantara hingga kuliner dunia paling lengkap dengan katalog kami
            </div>
            <div class="column">
                <img class="ui left floated image" data-src="{{ asset('images/gratis1.png') }}" height="100px">
                Buka dan kelola gerai online Anda secara mudah ,nyaman dan gratis
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/image-slider/ads.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    <style>
        div#column-main-ads {
            padding-right: 5px;
        }
        div#column-side-ads {
             padding-left: 5px;
        }
        .ui.label>img {
            top: 5px !important;
            left: 5px !important;
        }
        .ui.transparent.left.corner.label {
            border-color: transparent;
        }
        .img-hit, .img-pick{
            /* optional way, set loading as background */
            background: url('/images/loading.gif') no-repeat 50% 50%;
        }
        .logo-pick {
            background: url('/images/loading.gif') no-repeat 50% 50%;
        }
    </style>
@endsection
@section('javascripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js"></script>
    <script src="{{ asset('plugins/imagefill/js/jquery-imagefill.js') }}"></script>
    <script src="{{ asset('js/category.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.img-ads').lazy({
                delay: 250
            });
            $('.logo-pick').lazy({
                delay: 250
            });
            $('.img-pick').lazy({
                delay: 250
            });
            $('.img-hit').lazy({
                delay: 250
            });
            $('img').lazy({
                delay: 250,
                afterLoad: function() {
                    $('div.image').imagefill();
                    $('a.image').imagefill();
                }
            });
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