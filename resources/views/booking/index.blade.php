@extends('_layout/dashboard/index')
@section('page_title', 'Pesanan')

@section('content')
<div class="row">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Pesanan</h3>
        </div>
        <div class="panel-body table-responsive table-full">
            <table class="table table-hover table-stripped table-bordered" style="margin-top: 1em" id="booking">
                <thead>
                <tr>
                    <th class="text-center">Tanggal Pesan</th>
                    <th>Kode Transaksi</th>
                    <th class="text-center">Jenis <br>Pembayaran</th>
                    <th class="text-center" width="15%">Total <br>Transaksi</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>21 Februari 2019</td>
                        <td>TRA023420482948</td>
                        <td>Transfer Bank Mandiri</td>
                        <td class="right labeled">124.000.000,-</td>
                        <td><button class="btn btn-primary">Detail</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
