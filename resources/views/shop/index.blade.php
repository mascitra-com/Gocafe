@extends('_layout.homepage.index')
@section('page_title', $shop->name)
@section('content')
    {{--Top Banner--}}
    <div class="ui breadcrumb container grid">
        <div class="twelve wide column">
            <a class="section" href="{{ url('/') }}">Home</a>
            <i class="right angle icon divider"></i>
            <span class="active section">{{ $shop->name }}</span>
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
@section('styles')
    <style>
        .ui.label>img {
            top: 5px !important;
            left: 5px !important;
        }
        .ui.transparent.left.corner.label {
            border-color: transparent;
        }
    </style>
@endsection
@section('javascripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.min.js"></script>
    <script src="{{ url('js/shop.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js"></script>
    <script src="{{ asset('plugins/imagefill/js/jquery-imagefill.js') }}"></script>
    <script>
        $('div.image').imagefill();
        $('.fa-stack').popup();
    </script>
@endsection