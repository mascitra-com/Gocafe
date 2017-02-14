@extends('_layout/dashboard/index')
@section('page_title', 'Staff Management')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">var base_url = '{{ url()->full() }}'</script>
@stop

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title pull-left"><i class="fa fa-fw fa-users"></i> Staff Management</h3>
				<div class="btn-group btn-group-sm pull-right" role="group">
					<a class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">refresh</span></a>
					<a class="btn btn-default" href="{{ url('staff/create') }}"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span></a>
					<button class="btn btn-default" data-toggle="modal" data-target="#import-dialog"><i class="fa fa-fw fa-upload"></i> <span class="hidden-sm">import</span></button>
				</div>
				<!-- QUICK SEARCH -->
				<form action="#" class="pull-right hidden-xs">
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
				<table class="table table-stripped table-hover table-bordered">
					<thead>
						<tr>
							<th class="text-center">Staff ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th class="text-center text-nowrap">Cafe Branch</th>
							<th class="text-center text-nowrap">Position</th>
							<th class="text-center text-nowrap">Gender</th>
							<th class="text-center text-nowrap">Action</th>
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
							<td class="text-center text-nowrap">{{ $staff->branches->id }}</td>
							<td class="text-center text-nowrap">{{ $staff->position->title }}</td>
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
				<span class="panel-footer-text text-grey text-size-12 pull-left"><i class="fa fa-info-circle"></i> last edited at 02/01/2016 18:00</span>
				<nav aria-label="Page navigation" class="pull-right">
					<ul class="pagination pagination-sm">
						<li>
							<span aria-hidden="true">Show</span>
						</li>
						<li><a href="#">10</a></li>
						<li><a href="#">50</a></li>
						<li><a href="#">100</a></li>
						<li>
							<a href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li>
							<a href="#" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>
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
					<a href="#" class="btn btn-default"><i class="fa fa-download"></i> download format file</a>
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