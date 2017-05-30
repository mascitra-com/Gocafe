@extends('_layout.homepage.index')
@section('page_title', $shop->name)
@section('content')
    {{--Top Banner--}}
    <div class="ui breadcrumb container grid">
        <div class="twelve wide column">
            <a class="section" href="{{ url('/') }}">Home</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{ $shop->name }}</div>
        </div>
    </div>
    <div class="ui vertical segment container">
        <div class="row">
            <img class="ui image fluid" src="http://www.giftstokolkata.com/image/restaurant-banner.jpg" alt="Image">
        </div>
    </div>
    {{--Shop Section--}}
    @include('shop._shopinfo')
    {{--Product List--}}
    @include('shop._productslist')
@endsection
@section('javascripts')
    <script src="{{ url('plugins/jquery/jquery.number.min.js') }}"></script>
    <script src="{{ url('js/shop.js') }}"></script>
    <script>
        $('.fa-stack').popup();
    </script>
@endsection