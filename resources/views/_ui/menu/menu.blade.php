@extends('_layout/dashboard/index')
@section('page_title', 'Menu')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-theme">
			<div class="panel-heading">
				<h3 class="panel-title text-24 text-grey pull-left">Manajemen Menu</h3>
				<div class="btn-group btn-group-sm pull-right" role="group">
					<a class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i></a>
					<button class="btn btn-default" data-toggle="modal" data-target="#add-branches"><i class="fa fa-fw fa-plus"></i></button>
					<a href="#" class="btn btn-default" title="batch manage discount"><i class="fa fa-fw fa-percent"></i></span></a>
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
				<table class="table table-stripped table-hover">
					<thead>
						<th>Status</th>
						<th colspan="2">Menu</th>
						<th>Description</th>
						<th>Price</th>
						<th>Discount</th>
						<th></th>
					</thead>
					<tbody>
						@for($i=0;$i < 5; $i++)
						<tr>
							<td valign="middle"><button class="btn btn-xs btn-success">aktif</button></td>
							<td width="50px"><img src="{{URL::asset('images/blank-avatar.png')}}" class="thumb" alt=""></td>
							<td width="25%">
								<span class="text-size-16">Mie Ayam Gephok Pedas</span>
								<br>
								<span class="text-size-12" style="color:green">Makanan</span>
							</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit fugit, amet, laudantium commodi laboriosam voluptas.</td>
							<td class="text-nowrap"><b>Rp 30.000</b></td>
							<td><button class="btn btn-xs btn-success" data-id="01" data-discount="10">10%</button></td>
							<td class="text-center text-nowrap">
								<a class="btn btn-xs btn-default" href="#">...</a>
								<a class="btn btn-xs btn-default" href="#"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						@endfor
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
				<span class="panel-footer-text text-grey text-size-12 pull-left"><i class="fa fa-info-circle"></i> last edited at 01-11-2018 18:00</span>
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
<div class="modal fade" tabindex="-1" role="dialog" id="modal-discount">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Discount</h4>
			</div>
			<div class="modal-body">
				<form action="#" method="POST">
					<div class="form-group">
						<label for="">Discount Amount</label>
						<input type="hidden" name="id" value="">
						<div class="input-group">
							<input type="number" name="discount" min="0" class="form-control" placeholder="Discount Amount" />
							<span class="input-group-addon">%</span>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary">Save</button>
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
<style>
	.table > tbody > tr > td{
		vertical-align: middle;
	}

	tr > td:first-child{
		width: 6%;
		text-align: center;
	}

	tr > td:first-child button{
		padding: 3px 5px;
	}

	#modal-discount table tr td{
		text-align: left!important;
	}

	.thumb{
		width: 50px;
		height: 50px;
		object-fit: cover;
		object-position: center;
	}

	ul.pagination{
		margin: 0;
	}

	.label{
		display: block;
		width: 100%;
		font-weight: 300;
		font-size: 10pt;
	}
</style>
@endsection

@section('javascripts')
<script>
	$(document).ready(function(){
		$("[data-discount]").click(function(){
			$("#modal-discount input[name='id']").val($(this).data('id'));
			$("#modal-discount input[name='discount']").val($(this).data('discount'));
			$("#modal-discount").modal('show');
		});
	});
</script>
@endsection