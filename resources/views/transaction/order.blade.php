@extends('_layout/order/index')
@section('page_title', 'Pemesanan')

@section('content')
    <div class="row">
        <div class="col-md-6" id="productList">
            <div class="side-nav">
                <ul class="nav">
                    <li style="margin-right: 1em"><a href="#" disabled="true">KATEGORI</a></li>
                    <li style="margin-right: 15em"><a href="#" disabled="true">PRODUK</a></li>
                </ul>
            </div>
            <div class="row grid">
                <div class="list">
                    @foreach($categories as $category)
                        <button class="rectangle" onclick="showMenus('{{ $category->id }}')">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
            <div class="row grid2">
                <div class="list" id="product">
                    @foreach($menus as $menu)<button class="rectangle product" onclick="getProductDetail('{{ $menu->id }}')"><img src="{{ url("menus/showThumbnail/$menu->id")}}" alt="Thumbnail">{{ $menu->name }}</button>@endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6" style="overflow:auto; position:absolute; top:0; left:50%; right:0px; bottom:50px; z-index: 0" id="productDetail">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Detail Produk</h3>
                    <div class="pull-right" id="btn-add"><button class="btn btn-primary" onclick="addToCheck('{{ $firstMenu->id }}')"><i class="fa fa-plus"></i></button></div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <h3 id="head-menu">{{ $firstMenu->name }}</h3>
                    <div>
                        <i class="fa fa-star text-primary"></i>
                        <i class="fa fa-star text-primary"></i>
                        <i class="fa fa-star text-primary"></i>
                        <i class="fa fa-star text-primary"></i>
                        <i class="fa fa-star-half-o text-primary"></i>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="thumbnail">
                                <img style="max-height: 185px" src="{{ url("menus/showThumbnail/$firstMenu->id")}}" alt="Thumbnail" id="big-thumbnail">
                            </div>
                        </div>
                        <div class="col-md-6 table-responsive detail-menu">
                            <h4>Detail :</h4><br>
                            <table class="table">
                                <tr>
                                    <td class="text-primary">Harga</td>
                                    <td id="price">Rp. {{ number_format($firstMenu->price, 0, ',', '.') }},-</td>
                                </tr>
                                <tr>
                                    <td class="text-primary">Diskon</td>
                                    <td id="discount">@if($firstMenu->discount)
                                        - Rp. {{ number_format($firstMenu->price * $firstMenu->discount, 0, ',', '.') }},-
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row" id="thumbnails">
                        @for($i = 0; $i < 4; $i++)
                            <div class="col-xs-6 col-md-3">
                                <button class="thumbnail">
                                    <img src="{{ url("menus/showThumbnail/MCFDK120170419082141")}}" alt="Thumbnail">
                                </button>
                            </div>
                        @endfor
                    </div>
                    <div class="row col-md-12">
                        <h4>Deskripsi :</h4><br>
                        <p class="text-primary" id="menu-desc">{{ $firstMenu->description }}</p><br>
                    </div>
                    <div class="row col-md-12">
                        <h4>Ulasan :</h4><br>
                        {{-- TODO Use Ajax Instead --}}
                        <form action="{{ url('review') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="item_id" value="{{ $firstMenu->id }}" id="item_id">
                            <table class="table table-responsive">
                                <tr>
                                    <td>Penilaian Anda</td>
                                    <td>
                                        <div>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star-half-o text-primary"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ulasan Anda</td>
                                    <td><textarea name="review" class="form-control" id="review" rows="5"></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button class="btn btn-primary pull-right">Simpan</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="row col-md-12">
                        <table class="table table-responsive">
                            @for($i = 0; $i < 4; $i++)
                            <tr>
                                <td width="15%">
                                    <img src="{{ asset('images/blank-avatar.png') }}" alt="" class="img-circle img-responsive">
                                </td>
                                <td>
                                    <p style="font-size: 14pt" class="text-primary">Lorem Ipsum</p>
                                    Animi, culpa cumque, debitis dolor exercitationem hic impedit incidunt ipsum iure laboriosam laborum molestias non, porro praesentium quasi repudiandae sequi tempora velit? Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </td>
                            </tr>
                            @endfor
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .detail-menu {
            font-size: 12pt;
        }

        #head-menu {
            margin-bottom: .5em;
        }

        .product img {
            max-height: 80px;
            width: auto;
            margin: 0 0;
            vertical-align: top;
        }

        div.grid {
            margin-left: auto;
        }

        div.grid2 {
            margin-left: auto;
            margin-top: 2em;
        }

        button.product {
            background-image: linear-gradient(0deg, rgba(140, 71, 40, 0.75) 50%, rgba(255, 255, 255, 1) 100%, rgba(255, 255, 255, 1) 75%) !important;
            font-size: 12px !important;
            margin-top: 0.75em;
        }

        button.rectangle {
            background-image: linear-gradient(0deg, rgba(140, 71, 40, 0.75) 25%, rgba(140, 71, 40, 1) 25%, rgba(140, 71, 40, 0.8) 90%);
            height: 100px;
            width: 90px;
            border: 1px solid #7c4621;
            border-radius: 5px;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 0.6em;
            font-weight: bold;
        }

        .side-nav {
            width:100vh;
            height:25px;
            position:absolute;
            background:#8C4728;
            -webkit-transform-origin: left top;
            -webkit-transform:rotate(-90deg) translateX(-100%);
        }

        ul.nav li {
            margin-right:20px;
            float:right;
            height:100%;
            line-height:20px;
        }

        #productList ul.nav li a {
            color: whitesmoke;
            cursor: default;
        }

        .list {
            margin-left: 3em;
            margin-top: 1em;
        }

        .price {
            font-weight: bold;
            font-size: 13px;
        }

        .input-xs {
            height: 26px;
            padding: 2px 5px;
            font-size: 14px;
            line-height: 1.5; /* If Placeholder of the input is moved up, rem/modify this. */
            border-radius: 3px;
        }

        button.rectangle {
            cursor: pointer;
            overflow: hidden;
        }

        button.deleteMenu {
            background: Transparent no-repeat;
            border: none;
            cursor: pointer;
            overflow: hidden;
        }
    </style>
@endsection

@section('javascripts')
    <script src="{{ url('plugins/jquery/jquery.number.min.js') }}"></script>
    <script src="{{ url('js/payment.js') }}"></script>
    <script src="{{ url('js/order.js') }}"></script>
@endsection