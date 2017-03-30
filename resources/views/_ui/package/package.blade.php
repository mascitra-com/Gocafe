@extends('_layout/dashboard/index')
@section('page_title', 'Package')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-theme">
			<div class="panel-heading">
				<h3 class="panel-title pull-left"><i class="fa fa-cube"></i> Package Bundle</h3>
				<div class="btn-group btn-group-sm pull-right" role="group">
					<a class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh" title="refresh page"></i> <span class="hidden-sm">refresh</span></a>
					<a href="{{URL('ui/package/add')}}" class="btn btn-default" href="#" title="add new"><i class="fa fa-fw fa-plus"></i> <span class="hidden-sm">new</span></a>
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
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<td colspan="2">Package Info</td>
							<td class="text-center">Price</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@for($i=0; $i < 4; $i++)
						<tr>
							<td><img src="{{URL::asset('images/blank-avatar.png')}}" class="package-thumbnail" alt="thumbnail"></td>
							<td>
								<h4>Package title</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati eveniet incidunt maxime iste et voluptas.</p>
							</td>
							<td class="text-center"><span class="label label-success">Rp 10.000</span></td>
							<td>
								<a href="#" class="btn btn-default btn-xs"><i class="fa fa-ellipsis-h"></i></a>
								<a href="#" class="btn btn-default btn-xs"><i class="fa fa-image"></i></a>
								<a href="#" class="btn btn-default btn-xs" onclick="return confirm('are you sure?\nThis action cannot be undone.')"><i class="fa fa-times text-red"></i></a>
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
	.package-thumbnail{
		width: 100px;
		height: 100px;
		object-fit: cover;
		object-position: center;
	}

	.label{
		display: block;
		width: 100%;
		font-weight: 300;
		font-size: 12pt;
	}
	
	.pagination{
		margin: 0;
	}
</style>
@endsection