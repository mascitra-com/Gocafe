@extends('_layout/dashboard/index')
@section('page_title', 'Managemen Posisi')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title pull-left">Posisi</h3>
				<div class="btn-group btn-group-sm pull-right" role="group">
					<a class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">Segarkan</span></a>
					<button class="btn btn-default" data-toggle="modal" data-target="#modal1"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">Baru</span></button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body table-responsive table-full">
				<table class="table table-hover table-stripped table-borderd">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Judul</th>
							<th>Deskripsi</th>
							<th class="text-center">Hak Akses</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center">01</td>
							<td>Pelayan</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque similique pariatur labore eligendi, doloribus animi.</td>
							<td class="text-center"><button class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal2">001110011</button></td>
							<td class="text-center">
							<a href="#" class="btn btn-default btn-xs" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
				<span class="text-grey">last updated at 12/01/2017 08:35</span>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="modal1">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Posisi</h4>
			</div>
			<div class="modal-body">
				<form action="#">
					<div class="form-group">
						<label for="">Nama Posisi</label>
						<input type="text" class="form-control" name="title" placeholder="nama posisi">
					</div>
					<div class="form-group">
						<label for="">Deskripsi</label>
						<textarea name="description" class="form-control" placeholder="deskripsi posisi"></textarea>
					</div>
					<div class="form-group">
						<label for="">Hak Akses</label>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu1
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu2
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu3
									</label>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu4
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu5
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu6
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="button">simpan</button>
						<button class="btn btn-default" type="reset">batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal2">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Hak Akses Pelayan</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<div><i class="fa fa-check-circle"></i> Menu-1</div>
						<div><i class="fa fa-check-circle"></i> Menu-2</div>
						<div><i class="fa fa-ban"></i> Menu-3</div>
						<div><i class="fa fa-ban"></i> Menu-4</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div><i class="fa fa-ban"></i> Menu-5</div>
						<div><i class="fa fa-ban"></i> Menu-6</div>
						<div><i class="fa fa-ban"></i> Menu-7</div>
						<div><i class="fa fa-ban"></i> Menu-8</div>
					</div>
				</div>
				<div class="break-30"></div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
<style>
	.fa-ban{
		color: red;
	}

	.fa-check-circle{
		color: green;
	}
</style>
@endsection