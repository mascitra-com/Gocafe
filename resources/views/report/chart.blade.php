@extends('_layout/dashboard/index')
@section('page_title','Diagram')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title pull-left"><i class="fa fa-cutlery fa-fw"></i> Menu Terfavorit / 1 Bulan Terakhir</h3>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body table-responsive table-full">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Jenis</th>
							<th>Jumlah Pesanan</th>
						</tr>
					</thead>
					<tbody>
                    <?php $no = 1 ?>
                    @if($favProducts) @foreach($favProducts as $favorite)
                        <tr>
							<td>{{ $no++ }}</td>
							<td>{{ $favorite->name }}</td>
							<td>{{ $favorite->type }}</td>
							<td>{{ $favorite->total_order }} Pesanan</td>
						</tr>
                    @endforeach @endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-line-chart fa-fw"></i> Pengunjung / 30 Hari</h3>
			</div>
			<div class="panel-body">
                {!! $customers30day->render() !!}
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Jumlah Menu / 30 Hari</h3>
			</div>
			<div class="panel-body">
                {!! $menus30day->render() !!}
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-users fa-fw"></i> Jumlah Pendapatan / 3 Bulan</h3>
			</div>
			<div class="panel-body">
                {!! $revenue->render() !!}
            </div>
		</div>
	</div>
</div>
@endsection

@section('styles')
    {!! Charts::assets() !!}
@endsection