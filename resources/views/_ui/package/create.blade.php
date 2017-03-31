@extends('_layout/dashboard/index')
@section('page_title', 'Create Package')

@section('content')
<form action="#" method="post">
	<div class="row">
		<div class="col-xs-12 col-md-4">
			<div class="panel panel-theme">
				<div class="panel-heading">
					<h3 class="panel-title">Package Info</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" class="form-control" name="nama" placeholder="package name" required/>
					</div>
					<div class="form-group">
						<label for="">Description</label>
						<textarea class="form-control" name="deskripsi" placeholder="package description"></textarea>
					</div>
					<div class="form-group">
						<label for="">Price</label>
						<input type="number" name="harga" min="0" class="form-control" placeholder="price" required/>
					</div>
					<div class="form-group">
						<label for="">Discount</label>
						<div class="input-group">
							<input type="number" name="discount" class="form-control" placeholder="add discount" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-primary">Save</button>
					<button class="btn btn-warning" type="reset">Clear</button>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-8">
			<div class="panel panel-theme">
				<div class="panel-heading">
					<h3 class="panel-title">Menu On Package</h3>
				</div>
				<div class="panel-body table-responsive table-full">
					<table class="table table-striped table-hover">
						<thead>
							<td colspan="4">
								<div class="input-group">
									<input type="text" list="data-list" class="form-control" placeholder="serach menu">
									<datalist id="data-list">
										<option value="menu-1" />
										<option value="menu-2" />
										<option value="menu-3" />
									</datalist>
									<span class="input-group-btn">
										<button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
									</span>
								</div>
							</td>
						</thead>
						<tbody>
							<tr>
								<td><img src="{{URL::asset('images/blank-avatar.png')}}" alt="thumbnail" class="menu-thumbnail"></td>
								<td>
									<h4>Menu Title</h4>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, deleniti.</p>
								</td>
								<td><span class="label label-success">Rp 10.000</span></td>
								<td class="text-nowrap">
									<button class="btn btn-default btn-xs" type="button"><i class="fa fa-ellipsis-h"></i></button>
									<button class="btn btn-default btn-xs" type="button"><i class="fa fa-times text-red"></i></button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
	</div>
</form>
@endsection

@section('styles')
<style>
	.menu-thumbnail{
		width: 75px;
		height: 75px;
		object-fit: cover;
		object-position: center;
	}
	.label{
		display: block;
		width: 100%;
		font-size: 11pt;
		font-weight: 300;
	}
</style>
@endsection