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
                    @foreach($menus as $menu)
                        <button class="rectangle product" onclick="getProductDetail('{{ $menu->id }}')">
                            <img src="{{ url("menus/showThumbnail/$menu->id")}}" alt="Thumbnail">{{ $menu->name }}
                        </button>
                    @endforeach
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
                    <h2 id="head-menu">{{ $firstMenu->name }}</h2>
                    <div>
                        <input id="rating-avg" value="{{ $firstMenu->rating }}" class="rating" data-size="xs" data-show-clear="false" data-show-caption="false" readonly>
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
                                    <td id="discount">
                                        @if($firstMenu->discount)
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
                        <form id="form-review" action="">
                            {{ csrf_field() }}
                            <input type="hidden" name="item_id" value="{{ $firstMenu->id }}" id="item_id">
                            <table class="table table-responsive">
                                <tr>
                                    <td>Penilaian Anda</td>
                                    <td>
                                        <input name="rating" id="input-id" type="text" class="rating" data-size="xs" data-show-clear="false" data-show-caption="false" data-step="1">
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
                        <table class="table table-responsive" id="table-review">
                            @foreach($reviews as $review)
                            <tr>
                                <td width="15%">
                                    <img src="{{ asset('images/blank-avatar.png') }}" alt="" class="img-circle img-responsive">
                                </td>
                                <td>
                                    <p>
                                        <input id="rating-avg" value="{{ $review->rating }}" class="rating" data-size="xs" data-show-clear="false" data-show-caption="false" readonly>
                                    </p>
                                    {{ $review->review }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{URL::asset('css/order.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('javascripts')
    <script src="{{ url('plugins/jquery/jquery.number.min.js') }}"></script>
    <script src="{{ url('js/payment.js') }}"></script>
    <script src="{{ url('js/order.js') }}"></script>
    <script>
        $(document).on('ready', function(){
            $('#rating-avg').rating({displayOnly: true, step: 0.5});
        });
        $(function(){
            $('#form-review').on('submit',function(e){
                $.ajaxSetup({
                    header:$('meta[name="_token"]').attr('content')
                });
                e.preventDefault(e);
                $.ajax({
                    type:"POST",
                    url:'/review',
                    data:$(this).serialize(),
                    dataType: 'json',
                    success: function(data){
                        // TODO Make This Happen
                        // var markup = "<tr><td width='15%'><img src='{{ asset('images/blank-avatar.png') }}' alt='' class='img-circle img-responsive'></td><td><p><input id='rating-avg' value='"+data.review.rating+"' class='rating' data-size='xs' data-show-clear='false' data-show-caption='false' readonly></p>"+data.review.review+"</td></tr>";
                        // $("#table-review").find('tbody').append(markup);
                        alert('Ulasan Anda Sudah di Simpan. Silahkan Lanjutkan Pesanan Anda');
                    },
                    error: function(data){
                    }
                })
            });
        });
    </script>
@endsection