@extends('_layout.homepage.index')

@section('content')
    <div class="ui vertical segment container">
        <div class="row">
            <img class="ui image fluid" src="http://www.giftstokolkata.com/image/restaurant-banner.jpg" alt="Image">
        </div>
    </div>
    <div class="ui vertical segment container">
        <div class="ui two column divided grid">
            <div class="row">
                <div class="six column">
                    <h3>Royal Restaurant</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquam aut culpa, cum dicta dolor, doloremque enim impedit ipsam ipsum laborum neque officia pariatur possimus praesentium quasi quos similique voluptate.</p>
                </div>
                <div class="six column">
                    <img class="ui small left floated image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlHfIvsQ2CtsjxMC-GVIJFu7ab5I9GTdsMS5pelqZCFfvAYortrg">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic illo molestiae tempore. Laudantium magni maxime necessitatibus quod. Blanditiis cupiditate nisi recusandae reiciendis tempora. Iusto molestiae optio, pariatur repudiandae sed sint.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="ui vertical segment container">
        <div class="ui grid">
            <div class="three wide column">
                <h3>Kategori</h3>
                <div class="ui secondary vertical menu">
                    <a class="active brown item">
                        Makanan
                        <div class="ui brown left label">21</div>
                    </a>
                    <a class="item">
                        Minuman
                        <div class="ui label">25</div>
                    </a>
                    <a class="item">
                        Snack
                        <div class="ui label">12</div>
                    </a>
                    <div class="ui dropdown item">
                        <i class="dropdown icon"></i>
                        Lainnya
                        <div class="menu">
                            <a class="item">Small</a>
                            <a class="item">Medium</a>
                            <a class="item">Large</a>
                        </div>
                    </div>
                </div>
                <h3>Informasi</h3>
                <div class="ui secondary vertical menu">
                    <a class="item">
                        Tentang Kami
                    </a>
                    <a class="item">
                        Informasi Pengiriman
                    </a>
                    <a class="item">
                    Syarat & Ketentuan
                    </a>
                    <a class="item">
                        Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="thirteen wide column" style="padding-left: 2em">
                <h3>Produk</h3>
                <div class="ui three doubling cards">
                    @for($i = 1; $i <= 9; $i++)
                        <div class="card">
                            <div class="image">
                                <img src="https://semantic-ui.com/images/wireframe/image.png">
                            </div>
                            <div class="content">
                                <div class="header">Makanan {{ $i }}</div>
                            </div>
                            <div class="extra content">
                                <span class="right floated">
                                Di Pesan {{ $i * 32 }}x
                                </span>
                                <span>
                                <i class="heart brown icon"></i>
                                Disukai {{ $i *13 }}x
                                </span>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    {{--Footer--}}
    <div class="ui vertical footer segment">
        <div class="ui container">
            <div class="ui stackable divided equal height stackable grid">
                <div class="five wide column">
                    <h4 class="ui header">About</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Sitemap</a>
                        <a href="#" class="item">Contact Us</a>
                        <a href="#" class="item">Religious Ceremonies</a>
                        <a href="#" class="item">Gazebo Plans</a>
                    </div>
                </div>
                <div class="six wide column">
                    <h4 class="ui header">Services</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Banana Pre-Order</a>
                        <a href="#" class="item">DNA FAQ</a>
                        <a href="#" class="item">How To Access</a>
                        <a href="#" class="item">Favorite X-Men</a>
                    </div>
                </div>
                <div class="five wide column">
                    <h4 class="ui header">Footer Header</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab beatae dolorem itaque neque praesentium?</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}">
@endsection

@section('javascripts')
    <script>
        $('.ui.dropdown').dropdown({
            on: 'hover'
        });
    </script>
@endsection