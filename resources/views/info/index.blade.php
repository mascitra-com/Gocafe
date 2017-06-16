@extends('_layout.homepage.index')
@section('page_title', 'Tentang Kami')
@section('content')
    <div class="ui main text container" style="margin-bottom: 5em">
        <h2 class="ui header center aligned" style="margin-top: 1em">{{ $info->title }}</h2><br>
        {{ $info->body }}
    </div>
@endsection