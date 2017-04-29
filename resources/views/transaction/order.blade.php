@extends('_layout/transaction/index')
@section('page_title', 'Pemesanan')

@section('navbar-right')
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-shopping-cart text-secondary"></i> <span class="text-secondary">Pesanan</span><span
                            class="caret text-secondary" id="cart"></span></a>
                <div class="dropdown-menu" style="width: 500px; margin: .5em .5em">
                    <form action="{{ url('order') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="table_number" value="">
                        <input type="hidden" name="status" value="0">
                        <table class="table text-quintuple" id="bill">
                            <thead>
                            <tr>
                                <th width="5%"></th>
                                <th width="37.5%">Nama</th>
                                <th width="27.5%">Jumlah</th>
                                <th width="25%">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <table class="table text-quintuple">
                            <tr>
                                <td style="font-weight: bold; font-size: 16px" colspan="2">Total Keseluruhan</td>
                                <td colspan="2" class="text-right"><label class="total price" for="price" style="font-size: 16px">Rp. 0</label></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold; font-size: 16px" colspan="2">Total Diskon</td>
                                <td colspan="2" class="text-right"><label class="discount price" for="price" style="font-size: 16px">- Rp. 0</label></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold; font-size: 16px" colspan="2">Total Pembayaran</td>
                                <td colspan="2" class="text-right"><label class="final price" for="price" style="font-size: 16px">Rp. 0</label></td>
                            </tr>
                            <tr>
                                <td colspan="4"><button class="btn btn-primary btn-block" type="submit"><b style="font-size: 16px">Pesan</b></button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </li>
            <li>
                <div class="pull-right row" style="width: 225px; margin-top: .6em">
                    <span for="table_number" class="col-md-6" style="margin-top: .5em; color:#fff;">Nomor Meja</span>
                    <select id="table_number" class="form-control col-md-6" style="width: 75px">
                        <option value="">Pilih</option>
                        @for($i = 1; $i <= $numberOfTables; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </li>
        </ul>
    </div>
@endsection

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
        var url = "{{ url('') }}";
        $('#table_number').on('change', function() {
            $.ajax({
                url: '/transaction/getMenusByTableNumber/' + this.value,
                dataType: 'json',
                success: function () {
                    var conf = confirm('Meja Ini Masih Terdapat Transaksi yg Belum Dibayarkan / Sudah Di Pesan! Anda');
                    if(!conf){
                        $('#table_number').val('');
                        $('input[name ="table_number"]').val('');
                    }
                }
            });
            $('input[name ="table_number"]').val($('#table_number').val());
        });
    </script>
@endsection