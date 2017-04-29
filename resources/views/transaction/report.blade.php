@extends('_layout/dashboard/index')
@section('page_title', 'Laporan Transaksi')

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
				<h3 class="panel-title">Daftar Transaksi</h3>
			</div>
			<div class="panel-body table-responsive table-full">
                <div style="margin: .5em 0em" class="row">
                    <div class="col-md-2" style="margin-top: .5em">
                        <label for="daterange" class="text-quadruple">Rentang Tanggal</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="daterange" id="daterange" class="form-control">
                    </div>
                    <div class="col-md-2" style="margin-top: .5em">
                        <label for="payment_type" class="text-quadruple">Jenis Pembayaran</label>
                    </div>
                    <div class="col-md-4">
                        <select name="payment_type" id="payment_type" class="form-control">
                            <option value="">Semua Jenis Pembayaran</option>
                            <option value="1">Tunai</option>
                            <option value="-1">Kartu Kredit</option>
                            <option value="-2">Kartu Debit</option>
                        </select>
                    </div>
                </div>
				<table class="table table-hover table-stripped table-bordered" style="margin-top: 1em" id="report">
					<thead>
						<tr>
							<th class="text-center">Tanggal Transaksi</th>
							<th>Kode Transaksi</th>
							<th class="text-center" width="15%">Total <br>Transaksi</th>
							<th class="text-center">Jenis <br>Pembayaran</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@if($transactions) @foreach($transactions as $transaction)
                        <tr>
                            <td class="text-center">{{ date('d-M-Y H:i:s', strtotime($transaction->created_at)) }}</td>
							<td>{{ $transaction->id }}</td>
							<td class="text-right" style="padding-right: 2em">Rp. {{ number_format($transaction->total_payment, 0, ',', '.') }},-</td>
                            <td class="text-center">{{ $transaction->status === 0 ? 'Belum di Bayar' : ($transaction->status === 1 ? 'Tunai' : 'Kartu Kredit') }}</td>
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

@section('styles')
    <!-- Include Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <link rel="stylesheet" href="{{URL::asset('css/report.css')}}">
@endsection

@section('javascripts')
    <script src="{{ url('plugins/jquery/jquery.number.min.js') }}"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>
    <script>
        $(document).ready( function () {
            $('input[name="daterange"]').daterangepicker(
            {
                "startDate": moment().startOf('month'),
                locale: {
                    format: 'YYYY-MM-DD'
                }
            },
            function(start, end, label) {
                var payment_type = $("#payment_type option:selected").val();
                if(payment_type === '') {
                    payment_type = "-";
                }
                get_report_json(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), payment_type);
            });
            $('select#payment_type').on('change', function (e) {
                var payment_type = this.value;
                if(payment_type === '') {
                    payment_type = "-";
                }
                var date = $('input[name="daterange"]').val().split(' - ');
                get_report_json(date[0], date[1], payment_type);
            });
        });
        function get_report_json(start, end, payment_type) {
            $.ajax({
                url: '/filter_report/' + start + '/' + end + '/' + payment_type,
                dataType: 'json',
                success: function (response) {
                    $('#report').find('tbody').empty();
                    $.each(response.transactions, function (i, transaction) {
                        var status;
                        if (transaction.status === 1) {
                            status = 'Tunai';
                        } else if (transaction.status === -1) {
                            status = 'Kartu Kredit';
                        }
                        var markup = "<tr><td class='text-center'>" + $.format.date(transaction.created_at, 'dd-MMM-yyyy hh:mm:ss') + "</td><td>" + transaction.id + "</td><td class='text-right' style='padding-right: 2em'>Rp. " + $.number(transaction.total_payment, 0, ',', '.') + ",-</td><td class='text-center'>" + status + "</td><td><a href='#' class='btn btn-info'><i class='fa fa-info'></i> Detail</a></td></tr>";
                        $("#report").find('tbody').append(markup);
                    });
                }
            })
        }
    </script>
@endsection