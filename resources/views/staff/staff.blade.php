@extends('_layout/dashboard/index')
@section('page_title', 'Staf')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">var base_url = '{{ url()->full() }}'</script>
@stop

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title pull-left"><i class="fa fa-fw fa-users"></i> Manajemen Staf</h3>
				<div class="btn-group btn-group-sm pull-right" role="group">
					<a class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">Segarkan</span></a>
					<a class="btn btn-default" href="{{ url('staff/create') }}"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">Tambah</span></a>
					<button class="btn btn-default" data-toggle="modal" data-target="#import-dialog"><i class="fa fa-fw fa-upload"></i> <span class="hidden-sm">Import</span></button>
				</div>
				<!-- QUICK SEARCH -->
				<form action="#" class="pull-right hidden-xs">
					<div class="form-group">
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" placeholder="Cari">
							<span class="input-group-btn">
								<button class="btn btn-default"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body table-responsive table-full">
				<table class="table table-stripped table-hover table-bordered">
					<thead>
						<tr>
							<th class="text-center">ID Staf</th>
							<th>Nama Depan</th>
							<th>Nama Belakang</th>
							<th class="text-center text-nowrap">Penempatan</th>
							<th class="text-center text-nowrap">Posisi</th>
							<th class="text-center text-nowrap">Jenis Kelamin</th>
							<th class="text-center text-nowrap">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<!-- FORM FILTER -->
							<form action="#">
								<td><input type="text" class="form-control input-sm" name="id" placeholder="staff id"></td>
								<td><input type="text" class="form-control input-sm" name="first_name" placeholder="first name"></td>
								<td><input type="text" class="form-control input-sm" name="last_name" placeholder="last name"></td>
								<td>
									<select name="branch_id" class="form-control input-sm">
										<option value="">All</option>
										<option value="1">Branch #1</option>
									</select>
								</td>
								<td>
									<select name="position_id" class="form-control input-sm">
										<option value="">All</option>
										<option value="1">Position #1</option>
									</select>
								</td>
								<td>
									<select name="gender" class="form-control input-sm">
										<option value="">All</option>
										<option value="0">Male</option>
										<option value="1">Female</option>
									</select>
								</td>
								<td><button class="btn btn-sm btn-default btn-block"><i class="fa fa-search"></i></button></td>
							</form>
						</tr>
						<!-- DATA START HERE -->
						@foreach($staffs as $staff)
						<tr>
							<td class="text-center text-nowrap">{{ $staff->id }}</td>
							<td>{{ $staff->first_name }}</td>
							<td>{{ $staff->last_name }}</td>
							<td class="text-center text-nowrap">{{ $staff->branches->district->name }}</td>
							<td class="text-center text-nowrap">{{ $staff->position_id == 1 ? 'Kasir' : ($staff->position_id == 2 ? 'Pramusaji' : ($staff->position_id == 3 ? 'Juru Masak' : ''))}}</td>
							<td class="text-center text-nowrap">@if($staff->gender === '0') Laki-Laki @else Perempuan @endif</td>
							<td class="text-center text-nowrap">
								<a href="{{ url('staff/'.$staff->id.'/edit') }}" class="btn btn-default btn-xs"><i class="fa fa-info-circle"></i></a>
								<button class="btn btn-default btn-xs" onclick="delete_staff('{{ $staff->id }}')" id="delete-staff"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
				<span class="panel-footer-text text-grey text-size-12 pull-left"><i class="fa fa-info-circle"></i> last edited at 01-11-2018 18:00</span>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="import-dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Import data</h4>
			</div>
			<div class="modal-body">
				<p>Import data staff dalam bentuk file excel. Gunakan format file yang telah disediakan dibawah</p>
				<div class="break-50"></div>
				<form action="{{ url('staff/import') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
					<div class="form-group">
						<label for="import_excel"> Pilih file</label>
						<input type="file" name="import_excel">
					</div>
					<button class="btn btn-primary" type="submit">Upload</button>
					<a href="{{ url('staff/download') }}" class="btn btn-default"><i class="fa fa-download"></i> Download Format File</a>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
<style>
	.pagination{
		margin: 0;
	}
</style>
@endsection

@section('javascripts')
<script type="text/javascript" src="{{URL::asset('js/Staff/staff.js')}}"></script>
@stop