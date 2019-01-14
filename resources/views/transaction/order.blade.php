@extends('_layout/transaction/index')
@section('page_title', 'Pemesanan & Pembayaran')


@section('navbar-right')
    <div class="pull-right" style="margin-right: 1em">
        <button class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#table-availability">Pilih Meja</button>
    </div>
@endsection


@section('content')
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav" style="margin-top: 1em">
                @foreach($categories as $category)
                    <li>
                        <span style="font-size: 15pt"><a href="#" onclick="showMenus('{{ $category->id }}')">{{ strtoupper($category->name) }}</a></span>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8" id="productList">
                        <div class="row grid2">
                            <div class="list" id="product">
                                @foreach($menus as $menu)
                                    <button class="rectangle product" onclick="getProductDetail('{{ $menu->id }}')">
                                        <img src="{{ url($menu->thumbnail)}}" alt="Thumbnail">{{ $menu->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form action="{{ url('order') }}" method="POST" onsubmit="return validateForm()">
                            {{ csrf_field() }}
                            <div class="panel-heading">
                                <label for="table_number" class="col-md-6" style="margin-top: .5em">Nomor Meja : </label>
                                <h2 id="label_table_number">-</h2>
                                <input type="hidden" id="table_number" name="table_number" value="">
                                <div class="clearfix"></div>
                            </div>
                            <table class="table text-quintuple" id="bill">
                                <thead>
                                <tr>
                                    <th width="5%"></th>
                                    <th width="30%">Nama</th>
                                    <th>Jumlah</th>
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
                                    <td colspan="2" class="text-right"><label class="discount price" for="price" style="font-size: 16px">Rp. 0</label></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; font-size: 16px" colspan="2">Total Pembayaran</td>
                                    <td colspan="2" class="text-right"><label class="final price" for="price" style="font-size: 16px">Rp. 0</label></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <button class="btn btn-primary btn-block" type="submit"><b style="font-size: 16px">Pesan</b></button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="product-detail">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-primary pull-right" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <h2 id="head-menu">{{ $firstMenu->name }}</h2>
                    <div id="total-rating">
                        <input value="" class="rating-avg" data-size="xs" data-show-clear="false" data-show-caption="false" readonly>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img style="max-height: 250px" src="{{ url("$firstMenu->thumbnail")}}" alt="Thumbnail" id="big-thumbnail">
                            </div>
                        </div>
                        <div class="col-md-4 table-responsive detail-menu">
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
                                            Rp. {{ number_format($firstMenu->price * $firstMenu->discount, 0, ',', '.') }},-
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="btn-add">
                                            <button class="btn btn-primary" onclick="addMenuToCheck('{{ $firstMenu->id }}')"><i class="fa fa-plus"></i> Pesan</button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row" id="thumbnails">
                        @for($i = 0; $i < 4; $i++)
                            <div class="col-xs-6 col-md-3">
                                <button class="thumbnail">
                                    <img src="" alt="Thumbnail">
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
                                        <input name="rating" id="rating" type="text" class="rating" data-size="xs" data-show-clear="false" data-show-caption="false" data-step="1">
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
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="table-availability">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-primary pull-right" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <h2>Ketersediaan Meja</h2>
                </div>
                <div class="modal-body">
                    {!! $table !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{URL::asset('css/order.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/sidebar.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('javascripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.min.js"></script>
    <script src="{{ url('js/payment.js') }}"></script>
    <script src="{{ url('js/order.js') }}"></script>
    <script>
        $(document).on('ready', function(){
            $('.rating-avg').rating({displayOnly: true, step: 0.5});
        });
        $("#wrapper").toggleClass("toggled");
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
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
                        var markup = "<tr><td width='15%'><img src='{{ asset('images/blank-avatar.png') }}' alt='' class='img-circle img-responsive'></td><td><p><input class='rating-avg' value='"+data.review.rating+"' class='rating' data-size='xs' data-show-clear='false' data-show-caption='false' readonly></p><p>" + data.review.review + "</p><p><span class='label label-default'>Baru Saja</span></p></td></tr>";
                        $("#table-review").find('tbody').prepend(markup);
                        $('.rating-avg').rating({displayOnly: true, step: 0.5});
                        $('#total-rating').empty().append("<input value='" + data.newRating + "' class='rating-avg' data-size='xs' data-show-clear='false' data-show-caption='false' readonly>");
                        $('.rating-avg').rating({displayOnly: true, step: 0.5});
                        $('#form-review').hide();
                    },
                    error: function(data){
                    }
                })
            });
        });
        var url = "{{ url('') }}";

        function getMenusByTableNumber(id) {
            $("input#table_number").val(id);
            $("#bill").find("tbody").empty();
            $("label.total").html('Rp. 0');
            $("#label_table_number").html(id);
            $("label.discount").html('Rp. 0');
            $("label.final").html('Rp. 0');
            $('input[name="_method"]').remove();
            $('#form-payment').attr('action', url + '/payment');
            $.ajax({
                url: '/transaction/getMenusByTableNumber/' + id,
                dataType: 'json',
                success: function (response) {
                    var transactionId = response.transactionId['id'];
                    if(transactionId) {
                        $.each(response.items, function (i, item) {
                            addMenuToCheck(item.item_id, item.amount, false);
                            addPackageToCheck(item.item_id, item.amount);
                        });
                        getPaymentDetail(transactionId);
                        $('#form-payment').attr('action', url + '/payment/' + response.transactionId['id'])
                            .append('{{ method_field('PATCH') }}');
                    } else {
                        $("label.discount").html("Rp. 0");
                    }
                    $('#table-availability').modal('hide');
                }
            })
        }
    </script>
@endsection