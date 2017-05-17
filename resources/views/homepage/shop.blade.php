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
                    <h3>{{ $cafe->name }}</h3>
                    <p>{{ $cafe->description }}</p>
                </div>
                <div class="six column">
                    <div class="ui grid">
                        <div class="four wide column">
                            <img class="ui small image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlHfIvsQ2CtsjxMC-GVIJFu7ab5I9GTdsMS5pelqZCFfvAYortrg">
                        </div>
                        <div class="twelve wide column">
                            <table class="ui table table-responsive" style="border: none">
                            <tr>
                                <td><a target="_blank" href="https://www.facebook.com/{{ $cafe->facebook }}"><i class="fa fa-facebook-square"></i> {{ $cafe->facebook }}</a></td>
                                <td><a target="_blank" href="https://www.twitter.com/{{ $cafe->twitter }}"><i class="fa fa-twitter-square"></i> {{ $cafe->twitter }}</a></td>
                            </tr>
                            <tr>
                                <td><a target="_blank" href="https://www.instagram.com/{{ $cafe->instagram }}"><i class="fa fa-instagram"></i> {{ $cafe->instagram }}</a</td>
                                <td style="color: #F18803"><i class="fa fa-phone-square"></i> {{ $cafe->phone }}</td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui vertical segment container">
        <div class="ui grid">
            <div class="three wide column">
                <h3>Kategori</h3>
                <div class="ui secondary vertical menu">
                    @foreach($categories as $category)
                        <a class="brown item" data-id="{{ $category->id }}">
                            {{ $category->name }}
                            {{--<div class="ui brown left label">21</div>--}}
                        </a>
                    @endforeach
                </div>
                <h3>Informasi</h3>
                <div class="ui secondary vertical menu">
                    <a class="item">
                        Tentang Kami
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
                <div class="ui three doubling cards" id="productList">
                    @foreach($menus as $menu)
                        <a class="card product" data-id="{{ $menu->id }}">
                            <div class="image">
                                <img src="{{url("menus/showThumbnail/$menu->id")}}">
                            </div>
                            <div class="content">
                                <div class="header">{{ $menu->name }}</div>
                            </div>
                            <div class="extra content">
                                <span>
                                <i class="money brown icon"></i>
                                <b>Rp. {{ number_format($menu->price, 0, ',', '.') }}</b>
                                </span>
                                <span class="right floated">
                                    <div class="ui star rating right floated" data-rating="{{ floor($menu->rating) }}"></div>
                                </span>
                            </div>
                        </a>
                    @endforeach
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
@section('modal')
    <div class="ui long modal">
        <i class="close icon"></i>
        <div class="header">
            Profile Picture
        </div>
        <div class="content">
            <div class="ui grid">
                <div class="row">
                    <div class="eight wide column">
                        <img src="" id="big-thumbnail" class="ui fluid image">
                    </div>
                    <div class="eight wide column">
                        <div class="ui header">We've auto-chosen a profile image for you.</div>
                        <p>We've grabbed the following image from the <a href="https://www.gravatar.com" target="_blank">gravatar</a> image associated with your registered e-mail address.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aut ducimus eligendi fugiat hic maiores non odio optio, porro rem repellendus reprehenderit tempora temporibus ullam, vel. Amet cum pariatur reprehenderit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos obcaecati odit omnis perspiciatis quasi velit voluptatem! Cum, hic, iste! Ad alias animi aperiam dolorem eligendi incidunt perspiciatis quos repellendus sequi?</p>
                        <p>Is it okay to use this photo?</p>
                    </div>
                </div>
                <div class="row">
                    <div class="sixteen wide column">
                    <div class="ui four doubling cards" id="thumbnails">
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}">
@endsection

@section('javascripts')
    <script src="{{ url('plugins/jquery/jquery.number.min.js') }}"></script>
    <script>
        var hostname = window.location.hostname;

        $(document).ready(function() {
            $('.ui.star.rating').rating({
                maxRating: 5
            }).rating('disable');
        });
        $("a.brown").first().addClass("active");
        $('.ui.dropdown').dropdown({
            on: 'hover'
        });

        $('.card.product').click(productDetail);

        function productDetail(event){
            var productId = $(event.currentTarget).data("id");
            $('#big-thumbnail').attr('src', getThumbnail(productId));
            $('#thumbnails').find('div').remove();
            $.ajax({
                url: '/menus/getMenu/' + productId,
                dataType: 'json',
                success: function (response) {
                    $.each(response.menu, function (i, menu) {
                        $('.modal > .header').html(menu.name);
                        var images = menu.images_name.split(':').filter(n => n);
                        var thumbnails = '';
                        var k = 1;
                        var imageSrc = '';
                        $.each(images, function (i, image) {
                            if(image === 'default') {
                                imageSrc = imageUrl(images[i - k++]);
                            } else {
                                imageSrc = imageUrl(image);
                            }
                            thumbnails += "<div class='card'><div class='image'><img src='" + imageSrc + "'></div></div>";
                            $('#thumbnails').html(thumbnails);
                        });
                    });
                },
                complete : function () {
                    $('.ui.long.modal').modal('show');
                }
            });

        }

        function imageUrl(image) {
            return "http://"+ hostname + "/menus/showImage/" + image ;
        }

        $("a.brown").click(function(){
            $("a.brown").removeClass("active").eq($(this).index()).addClass('active');
            var idCategory = $(this).data("id");
            var menus = $('#productList').empty();
            $.ajax({
                url: '/menus/getMenus/' + idCategory,
                dataType: 'json',
                success: function (response) {
                    $.each(response.menus, function (i, menu) {
                        var id = menu.id;
                        var name = menu.name;
                        var price = $.number(menu.price, 0, '', '.');
                        var rating = Math.floor(menu.rating);
                        var markup = "<a class='card product' data-id='"+id+"'><div class='image'><img src='" + getThumbnail(id) + "'></div><div class='content'><div class='header'>" + name + "</div></div><div class='extra content'><span><i class='money brown icon'></i><b>Rp." + price + "</b></span><span class='right floated'><div class='ui star rating right floated' data-rating='" + rating + "'></div></span></div></a>";
                        $("#productList").append(markup);
                    });
                    $('#productList').delegate('a.card.product', 'click', productDetail);
                    $('.ui.star.rating').rating({
                        maxRating: 5
                    }).rating('disable');
                }
            });
        });

        function getThumbnail(idMenu) {
            return "http://" + hostname + "/menus/showThumbnail/" + idMenu;
        }
    </script>
@endsection