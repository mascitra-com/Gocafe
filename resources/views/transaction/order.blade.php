@extends('_layout/order/index')
@section('page_title', 'Pemesanan')

@section('content')
    <div class="row">
        <div class="col-md-6">
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
                                <td colspan="2" class="text-right"><label class="final price" for="price" style="font-size: 16px">Rp. 0</label></td>
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
                                <td colspan="2"><input type="text" id="cash_received" name="cash_received"></td>
                            </tr>
                            <tr class="cash">
                                <td colspan="2"><label for="refund">Jumlah Uang Kembali</label></td>
                                <td colspan="2"><input type="text" id="refund" name="refund" readonly></td>
                            </tr>
                            <tr>
                                <td><button class="btn btn-primary btn-block" type="sumit"><b style="font-size: 16px">Bayar</b></button></td>
                                <td><button class="btn btn-secondary btn-block" type="button" id="reset"><b style="font-size: 16px">Batal</b></button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="menus">
            <div class="side-nav">
                <ul class="nav">
                    <li style="margin-right: 1em"><a href="#" disabled="true">KATEGORI</a></li>
                    <li style="margin-right: 15em"><a href="#" disabled="true">PRODUK</a></li>
                </ul>
            </div>
            <div id="list">
                <button class="kategori"><b>Makanan</b></button>
                <button class="kategori"><b>Minuman</b></button>
                <button class="kategori"><b>Snack</b></button>
                <button class="kategori"><b>Kopi</b></button>
                <button class="kategori"><b>Roti Bakar</b></button>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        button.kategori {
            background-image: linear-gradient(0deg, rgba(140, 71, 40, 0.75) 25%, rgba(140, 71, 40, 1) 25%, rgba(140, 71, 40, 0.8) 90%);
            height: 100px;
            width: 90px;
            border: 0.5px solid #7c4621;
            border-radius: 5px;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 0.75em;
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

        ul.nav li a {
            color: whitesmoke;
            pointer-events: none;
            cursor: default;
        }

        #list {
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