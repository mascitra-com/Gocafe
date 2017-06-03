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
@endsection

@section('javascripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js"></script>
    <script src="{{ asset('plugins/imagefill/js/jquery-imagefill.js') }}"></script>
    <script>
        $('div.image').imagefill();
        $(document).ready(function() {
            $('.ui.rating.star').rating({
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