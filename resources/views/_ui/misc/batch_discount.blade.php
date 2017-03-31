@extends('_layout/dashboard/index')
@section('page_title', 'Batch Manage Discount')

@section('content')
<form action="#" method="POST">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-theme">
				<div class="panel-heading">
					<h3 class="panel-title pull-left">Batch Manage Discount</h3>
					<div class="btn-group pull-right">
						<button class="btn btn-default"><i class="fa fa-check text-green"></i> Save</button>
						<button class="btn btn-default"><i class="fa fa-times text-red"></i> Clear</button>
					</div>
					<div class="pull-right space-right-10">
						<div class="input-group">
							<input type="number" name="discount" class="form-control" placeholder="discount amount">
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body ">
					<div class="form-group">
						<label for="">Search menu/package</label>
						<div class="input-group">
							<input type="text" id="menu" list="menu-list" class="form-control" placeholder="search menu/package">
							<datalist id="menu-list">
								<option value="menu-1"/>
							</datalist>
							<span class="input-group-btn"><button class="btn btn-default" type="button">Add</button></span>
						</div>
					</div>
					<div class="tabel-responsive">
						<table class="table table-striped">
							@for($i=1; $i < 6; $i++)
							<tr>
								<td class="text-center" width="8%">0{{$i}}</td>
								<td>Menu Name</td>
								<td class="text-right"><span class="label label-success">Rp 10.000</span></td>
								<td class="text-right">
									<a href="#" class="btn btn-default"><i class="fa fa-ellipsis-h"></i></a>
									<button class="btn btn-default" type="button"><i class="fa fa-times text-red"></i></button>
								</td>
							</tr>
							@endfor
						</table>
					</div>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
	</div>
</form>
@endsection

@section('styles')
<style>
	td{
		vertical-align: middle!important;
	}
	td, td *{
		font-size: 12pt;
	}
</style>
@endsection