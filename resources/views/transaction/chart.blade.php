@extends('_layout/dashboard/index')
@section('page_title','Diagram')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title pull-left"><i class="fa fa-cutlery fa-fw"></i> Menu Terfavorit / 1 Bulan Terakhir</h3>
				<div class="btn-group btn-group-sm pull-right" role="group">
					<button type="button" class="btn btn-default"><i class="fa fa-refresh"></i></button>
					<button type="button" class="btn btn-default"><i class="fa fa-archive"></i></button>
					<button type="button" class="btn btn-default"><i class="fa fa-file-word-o"></i></button>
				</div>
				<form action="#" class="pull-right">
					<div class="form-group">
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" placeholder="search">
							<span class="input-group-btn">
								<button class="btn btn-default"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body table-responsive table-full">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Jumlah Pesanan</th>
						</tr>
					</thead>
					<tbody>
                    <?php $no = 1 ?>
                    @if($favMenus) @foreach($favMenus as $favorite)
                        <tr>
							<td>{{ $no++ }}</td>
							<td>{{ $favorite->name }}</td>
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
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-archive fa-fw"></i> PANEL</h3>
			</div>
			<div class="panel-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea quisquam doloremque dicta, consectetur ipsum necessitatibus quam temporibus, eveniet deleniti eligendi veritatis, sint tenetur autem ab dolorem blanditiis soluta eius maxime aut! Suscipit aliquid earum harum, quibusdam. Excepturi, perspiciatis minima voluptate explicabo aliquid consequuntur eum illum quam commodi! Accusamus ipsa quia vero autem porro pariatur reiciendis nisi culpa perferendis expedita. Quos?</p>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-archive fa-fw"></i> PANEL</h3>
			</div>
			<div class="panel-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea quisquam doloremque dicta, consectetur ipsum necessitatibus quam temporibus, eveniet deleniti eligendi veritatis, sint tenetur autem ab dolorem blanditiis soluta eius maxime aut! Suscipit aliquid earum harum, quibusdam. Excepturi, perspiciatis minima voluptate explicabo aliquid consequuntur eum illum quam commodi! Accusamus ipsa quia vero autem porro pariatur reiciendis nisi culpa perferendis expedita. Quos?</p>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
    {!! Charts::assets() !!}
@endsection