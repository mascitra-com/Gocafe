@extends('_layout.homepage.index')
@section('page_title', 'Tentang Kami')
@section('content')
    <div class="ui main">
        <div class="section" id="first"> </div>
        <div class="section" id="second"> </div>
        <div class="section" id="third"> </div>
        <div class="section" id="fourth"> </div>
        <div class="section" id="fifth">
            <div>
                <span>
                        Tunggu apa lagi!<br>
                        Daftarkan Kuliner Anda <br>
                        Di Kulinerae.com
                </span>
                <form action="#" class="ui form" style="margin-top: 1em">
                    <div class="field">
                        <input id="name" type="text" placeholder="Nama Kuliner Anda">
                    </div>
                    <button type="submit" class="ui inverted button fluid">Daftar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600" rel="stylesheet">
@endsection