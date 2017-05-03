@extends('_layout/dashboard/index')
@section('page_title', 'Laporan Pendapatan')

@section('content')
<div class="row">
	@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
	@endif
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Daftar Pendapatan</h3>
			</div>
			<div class="panel-body table-responsive table-full">
				<table class="table table-hover table-stripped table-bordered">
					<thead>
						<tr>
							<th class="text-center" width="20%">Tanggal Transaksi</th>
							<th class="text-center">ID Transaksi</th>
							<th class="text-center">Pendapatan</th>
							<th class="text-center">Jenis <br>Pembayaran</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@if($transactions) @foreach($transactions as $transaction)
                        <tr>
							<td class="text-center">{{ date('d-M-Y H:i:s', strtotime($transaction->created_at)) }}</td>
							<td class="text-center">{{ $transaction->id }}</td>
							<td class="text-center" style="padding-right: 2em">Rp. {{ number_format($transaction->total_payment - $transaction->production_cost, 0, ',', '.') }},-</td>
                            <td class="text-center">{{ $transaction->status === 1 ? 'Tunai' : 'Kartu Kredit' }}</td>
                            <td>
                                <a href="#" class="btn btn-info"><i class="fa fa-info"></i> Detail</a>
                            </td>
                       </tr>
                        @endforeach @endif
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
				<span class="text-grey">last edited by admin 12-02-2017 16:30</span>
			</div>
		</div>
	</div>
</div>
@endsection