@extends('_layout/dashboard/index')
@section('page_title', 'Cafe Branches')

@section('content')
<div class="content-title">Branches Insight</div>
<div class="row">
	<div class="col-xs-12 col-sm-4">
		<div class="panel panel-default panel-md">
			<div class="panel-body">
				<span class="text-grey">sub judul</span><br>
				<h4>Main Title</h4>
				<div class="break-5">Lorem ipsum dolor sit amet, consectetur adipisicing.</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4">
		<div class="panel panel-default panel-md">
			<div class="panel-body">
				<span class="text-grey">sub judul</span><br>
				<h4>Main Title</h4>
				<div class="break-5">Lorem ipsum dolor sit amet, consectetur adipisicing.</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4">
		<div class="panel panel-default panel-md">
			<div class="panel-body">
				<span class="text-grey">sub judul</span><br>
				<h4>Main Title</h4>
				<div class="break-5">Lorem ipsum dolor sit amet, consectetur adipisicing.</div>
			</div>
		</div>
	</div>
</div>

<div class="row break-20">
	<div class="col-xs-12 nopadding">
		<div class="panel panel-theme">
			<div class="panel-heading">
				<h3 class="panel-title pull-left">Branches</h3>
				<div class="btn-group btn-group-sm pull-right" role="group">
					<a class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">refresh</span></a>
					<button class="btn btn-default" data-toggle="modal" data-target="#add-branches"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span></button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body table-responsive table-full">
				<table class="table table-stripped">
					<tbody>
						<tr>
							<td>Cabang Jember</td>
							<td>Jember</td>
							<td>Jl. PB Soedirman 10</td>
							<td class="text-right"><a href="#" class="btn btn-xs btn-default"><i class="fa fa-info-circle fa-fw"></i> detail</a></td>
						</tr>
						<tr>
							<td>Cabang Bondowoso</td>
							<td>Bondowoso</td>
							<td>Jl. KH. Imam Bonjol</td>
							<td class="text-right"><a href="#" class="btn btn-xs btn-default"><i class="fa fa-info-circle fa-fw"></i> detail</a></td>
						</tr>
						<tr>
							<td>Cabang Lumajang</td>
							<td>Lumajang</td>
							<td>Jl. Letjen Suprapto 100</td>
							<td class="text-right"><a href="#" class="btn btn-xs btn-default"><i class="fa fa-info-circle fa-fw"></i> detail</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
<style>
	.nopadding{
		padding: 0;
	}

	.table > tbody tr td{
		padding-top: 20px;
		padding-bottom: 15px;
	}
</style>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="add-branches">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">New Branches</h4>
			</div>
			<div class="modal-body">
				<form action="#">
					<div class="form-group">
						<label for="">Location</label>
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<select name="" class="form-control">
									<option value="">select province</option>
								</select>
							</div>
							<div class="col-xs-12 col-md-4">
								<select name="" class="form-control">
									<option value="">select city</option>
								</select>
							</div>
							<div class="col-xs-12 col-md-4">
								<select name="" class="form-control">
									<option value="">select location</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Address</label>
						<textarea name="address" class="form-control" placeholder="Branch address"></textarea>
					</div>
					<div class="form-group">
						<label for="">Phone Number</label>
						<input type="text" class="form-control" name="phone" placeholder="phone number">
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="">Open Hours</label>
								<input type="text" class="form-control" name="open_hours" placeholder="open hours">
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="">Close Hours</label>
								<input type="text" class="form-control" name="close_hours" placeholder="close hours">
							</div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary"><i class="fa fa-save fa-fw"></i> save</button>
						<button class="btn btn-default"><i class="fa fa-refresh fa-fw"></i> reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection