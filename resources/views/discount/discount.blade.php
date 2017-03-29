@extends('_layout/dashboard/index')
@section('page_title', 'Diskon')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-theme">
			<div class="panel-heading">
				<h3 class="panel-title pull-left"><i class="fa fa-fw fa-percent"></i> Discount</h3>
				<div class="btn-group btn-group-sm pull-right" role="group">
					<a class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh" title="refresh page"></i> <span class="hidden-sm">refresh</span></a>
					<a href="{{URL('discount/create')}}" class="btn btn-default" href="#" title="add new"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span></a>
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
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Discount Name</th>
							<th>Description</th>
							<th class="text-center">Amount(%)</th>
							<th class="text-center">Expired Date</th>
							<th class="text-center">Status</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tbody>
						@for($i=1; $i < 5; $i++)
						<tr>
							<td class="text-center">0{{$i}}</td>
							<td>New Year's Special</td>
							<td>Discount for package A,B,C</td>
							<td class="text-center">
								<span class="label label-success text-size-14">{{str_pad($i * 5,2,'0',STR_PAD_LEFT)}}%</span>
							</td>
							<td class="text-center">12/12/2017</td>
							<td class="text-center">
								<span class="label label-primary">active</span>
							</td>
							<td class="text-center">
								<a href="{{URL('ui/diskon/detail')}}" class="btn btn-xs btn-default" title="detail"><i class="fa fa-ellipsis-h"></i></a>
								<a href="#" class="btn btn-xs btn-default"><i class="fa fa-power-off text-red" title="deactivated"></i></a>
								<a href="" class="btn btn-xs btn-default" onclick="return confirm('Are you sure?\nThis action cannot be undone')" title="delete"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endfor
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

@section('styles')
<style>
	.pagination{
		margin: 0;
	}

	.label{
		font-weight: 300;
	}
</style>
@endsection