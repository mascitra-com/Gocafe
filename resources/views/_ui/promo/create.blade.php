@extends('_layout/dashboard/index')
@section('page_title', 'Diskon')

@section('content')
<form action="#" method="POST">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="panel panel-theme">
				<div class="panel-heading">
					<h4 class="panel-title">Add Promo</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="">Promo Name</label>
								<input type="text" class="form-control" name="name" placeholder="promo name" required/>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="">Amount</label>
								<div class="input-group">
									<input type="number" name="amount" min="1" max="100" class="form-control" required/>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Promo Type</label>
						<select name="type" class="form-control">
							<option value="">Choose promo type</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Expiration Date</label>
						<input type="date" name="expired" class="form-control" placeholder="expiration date" />
						<p class="help-block">* Leave it blank if no expiration date</p>
					</div>
					<div class="form-group">
						<label for="">Description</label>
						<textarea class="form-control" name="description" placeholder="Promo description"></textarea>
					</div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-primary">Save</button>
					<button class="btn btn-warning">Clear</button>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="panel panel-theme">
				<div class="panel-heading">
					<div class="input-group">
						<input type="text" id="data" list="data-list" class="form-control" placeholder="choose menu">
						<datalist id="data-list">
							<option value="menu-1" />
							<option value="menu-2" />
							<option value="menu-3" />
						</datalist>
						<span class="input-group-btn">
							<button class="btn btn-default"><i class="fa fa-plus"></i></button>
						</span>
					</div>
				</div>
				<div class="panel-body table-full table-responsive">
					<table class="table table-striped">
						<tbody>
							@for($i=0; $i < 5; $i++)
							<tr>
								<td width="7%">01</td>
								<td>Menu A</td>
								<td class="text-right">
								<button type="button" class="btn btn-xs btn-default"><i class="fa fa-times text-red"></i></button>
								</td>
							</tr>
							@endfor
						</tbody>
					</table>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
	</div>
</form>
@endsection