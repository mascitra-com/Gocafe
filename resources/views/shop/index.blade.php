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
        <div class="row image" style="width: 1125px; height: 325px">
            <img class="ui image fluid" src="{{ $cover }}" alt="Image">
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js"></script>
    <script src="{{ asset('plugins/imagefill/js/jquery-imagefill.js') }}"></script>
    <script>
        $('div.image').imagefill();
        $('.fa-stack').popup();
    </script>
@endsection