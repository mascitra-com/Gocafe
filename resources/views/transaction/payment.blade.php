@extends('_layout/transaction/index')
@section('page_title', 'Pembayaran')

@section('navbar-right')
    <div class="pull-right" style="margin-top: .5em">
        <button class="btn btn-primary"  data-toggle="modal" data-target="#table-availability">Ketersediaan Meja</button>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 1em">
        <div class="col-xs-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Kategori</h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full">
                    <table class="table table-hover table-stripped table-bordered">
                        @foreach($categories as $category)
                            <tr onclick="showMenus('{{ $category->id }}')" id="tr-category" class="tr-selection">
                                <td class="text-quintuple">
                                    {{ strtoupper($category->name) }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-10">
            <div class="row">
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">{{ $categories[0]['name'] }}</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body table-responsive table-full">
                            <table class="table table-hover" id="menus">
                                @foreach($menus as $menu)
                                    <tr onclick="addToCheck('{{ $menu->id }}')" id="tr-menu"
                                        class="tr-selection text-quintuple">
                                        <td width="150px"><img src="{{url("menus/showThumbnail/$menu->id")}}"
                                                               class="img img-responsive" style="width: 150px;" alt="">
                                        </td>
                                        <td>
                                            {{ $menu->name }}
                                        </td>
                                        <td class="price text-right">
                                            Rp. {{ number_format($menu->price, 0, ',', '.') }} <br>
                                            @if($menu->discount)
                                                (- Rp. {{ number_format($menu->discount * $menu->price, 0, ',', '.') }})
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <form action="{{ url('payment') }}" method="POST" id="form-payment">
                            {{ csrf_field() }}
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Pembayaran</h3>
                                <div class="pull-right row" style="width: 225px">
                                    <label for="table_number" class="col-md-6" style="margin-top: .5em">Nomor Meja</label>
                                    <select name="table_number" id="table_number" class="form-control col-md-6" style="width: 75px">
                                        <option value="">Pilih</option>
                                        @for($i = 1; $i <= $numberOfTables; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body table-responsive table-full">
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
                                            <td style="font-weight: bold; font-size: 13pt" colspan="2">Total Keseluruhan</td>
                                            <td colspan="2" class="text-right"><label class="total price" for="price" style="font-size: 16pt">Rp. 0</label></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; font-size: 13pt" colspan="2">Total Diskon</td>
                                            <td colspan="2" class="text-right"><label class="discount price" for="price" style="font-size: 16pt">- Rp. 0</label></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; font-size: 13pt" colspan="2">Total Pembayaran</td>
                                            <td colspan="2" class="text-right"><label class="final price" for="price" style="font-size: 20pt">Rp. 0</label></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; font-size: 16px" colspan="2" rowspan="3">Jenis Pembayaran</td>
                                            <td><input type="radio" name="type" id="cash" value="1" checked></td>
                                            <td><label for="type">Tunai</label></td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;"><input type="radio" name="type" id="credit" value="-1"></td>
                                            <td><label for="type">Kartu Kredit</label></td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;"><input type="radio" name="type" id="debit" value="-2"></td>
                                            <td><label for="type">Kartu Debit</label></td>
                                        </tr>
                                        <tr class="credit_card">
                                            <td colspan="2"><label for="credit_name">Nama pada Kartu</label></td>
                                            <td colspan="2"><input type="text" id="credit_name" name="card_name"></td>
                                        </tr>
                                        <tr class="credit_card">
                                            <td colspan="2"><label for="credit_number">Nomor Kartu</label></td>
                                            <td colspan="2"><input type="text" id="credit_number" name="card_number"></td>
                                        </tr>
                                        <tr class="cash">
                                            <td colspan="2"><label for="cash_received">Pembayaran Yang Diterima</label></td>
                                            <td colspan="2" class="text-right"><input type="text" id="cash_received" name="cash_received"></td>
                                        </tr>
                                        <tr class="cash">
                                            <td colspan="2"><label for="refund">Jumlah Uang Kembali</label></td>
                                            <td colspan="2" class="text-right"><input type="text" id="refund" name="refund" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><button class="btn btn-primary btn-block" type="submit"><b style="font-size: 16pt">Bayar</b></button></td>
                                            <td><button class="btn btn-secondary btn-block" type="button" id="reset"><b style="font-size: 16pt">Batal</b></button></td>
                                        </tr>
                                    </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
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
    <link rel="stylesheet" href="{{URL::asset('css/payment.css')}}">
@endsection

@section('javascripts')
    <script src="{{ url('plugins/jquery/jquery.number.min.js') }}"></script>
    <script src="{{ url('js/payment.js') }}"></script>
    <script>
        $('#table-availability').modal('show');
        var url = "{{ url('') }}";
        $('#table_number').on('change', function() {
            $("#bill").find("tbody").empty();
            $("label.total").html('Rp. 0');
            $("label.discount").html('Rp. 0');
            $("label.final").html('Rp. 0');
            $('input[name="_method"]').remove();
            $('#form-payment').attr('action', url + '/payment');
            $.ajax({
                url: '/transaction/getMenusByTableNumber/' + this.value,
                dataType: 'json',
                success: function (response) {
                    $.each(response.menus, function (i, menu) {
                        addToCheck(menu.item_id);
                    });
                    $('#form-payment').attr('action', url + '/payment/' + response.transactionId)
                    .append('{{ method_field('PATCH') }}');
                }
            })
        });
    </script>
@endsection