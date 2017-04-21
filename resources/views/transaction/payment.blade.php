@extends('_layout/dashboard/index')
@section('page_title', 'Pembayaran')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Pembayaran</h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Pembayaran</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body table-responsive table-full">
                            <form action="{{ url('payment') }}" method="POST">
                                {{ csrf_field() }}
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
                                    <td colspan="2" class="text-right"><label class="final price" for="price" style="font-size: 30px">Rp. 0</label></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; font-size: 16px" colspan="2" rowspan="2">Jenis Pembayaran</td>
                                    <td><input type="radio" name="type" id="cash" value="cash" checked></td>
                                    <td><label for="type">Tunai</label></td>
                                </tr>
                                <tr>
                                    <td style=" padding-left: 8px;"><input type="radio" name="type" id="credit" value="credit"></td>
                                    <td><label for="type">Kartu Kredit</label></td>
                                </tr>
                                <tr class="credit_card">
                                    <td colspan="2"><label for="credit_name">Nama pada Kartu Kredit</label></td>
                                    <td colspan="2"><input type="text" id="credit_name" name="credit_card_name"></td>
                                </tr>
                                <tr class="credit_card">
                                    <td colspan="2"><label for="credit_number">Nomor Kartu Kredit</label></td>
                                    <td colspan="2"><input type="text" id="credit_number" name="credit_card_number"></td>
                                </tr>
                                <tr class="cash">
                                    <td colspan="2"><label for="cash_received">Pembayaran Yang Diterima</label></td>
                                    <td colspan="2"><input type="text" id="cash_received" name="cash_received" style="text-align: right;"></td>
                                </tr>
                                <tr class="cash">
                                    <td colspan="2"><label for="refund">Jumlah Uang Kembali</label></td>
                                    <td colspan="2"><input type="text" id="refund" name="refund" readonly style="text-align: right;"></td>
                                </tr>
                                <tr>
                                    <td><button class="btn btn-primary btn-block" type="submit"><b style="font-size: 16px">Bayar</b></button></td>
                                    <td><button class="btn btn-secondary btn-block" type="button" id="reset"><b style="font-size: 16px">Batal</b></button></td>
                                </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
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
@endsection