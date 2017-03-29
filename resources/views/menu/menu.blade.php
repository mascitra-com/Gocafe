@extends('_layout/dashboard/index')
@section('page_title', 'Menu')

@section('content')
<div class="row">
	@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
	@endif
	<div class="col-xs-12">
		<div class="panel panel-theme">
			<div class="panel-heading">
				<h3 class="panel-title text-24 text-grey pull-left">Manajemen Menu</h3>
				<div class="btn-group btn-group-sm pull-right" role="group">
					<a class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i></a>
					<a href="{{ url('menus/create') }}" class="btn btn-default"><i class="fa fa-fw fa-plus"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body table-responsive table-full">
				<table class="table table-stripped table-hover">
					<thead>
						<th>status</th>
						<th colspan="2">menu</th>
						<th>deskripsi</th>
						<th>harga</th>
						<th>aksi</th>
					</thead>
					<tbody>
						@foreach($menus as $menu)
						<tr>
							<td valign="middle"><button class="btn btn-xs btn-success">aktif</button></td>
							<td width="50px"><img src="{{URL::asset('images/blank-avatar.png')}}" class="thumb" alt=""></td>
							<td width="25%">
								<span class="text-size-16">{{ $menu->name }}</span>
								<br>
								<span class="text-size-12" style="color:green">{{ $menu->category->name }}</span>
							</td>
							<td>{{ $menu->description }}</td>
							<td class="text-nowrap"><b>Rp {{ $menu->price }}</b></td>
							<td class="text-center text-nowrap">
								<a class="btn btn-xs btn-default" href="{{ url('menus/'.$menu->id.'/edit') }}">...</a>
								<button class="btn btn-xs btn-default" onclick="delete_menu('{{ $menu->id }}')"><i class="fa fa-trash"></i></button>
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

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">var base_url = '{{ url()->full() }}'</script>
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

	.thumb{
		width: 50px;
		height: 50px;
		object-fit: cover;
		object-position: center;
	}

	ul.pagination{
		margin: 0;
	}
</style>
@endsection

@section('javascripts')
<script type="text/javascript">
	var token = $('meta[name="csrf-token"]').attr('content');

	function ajax_config() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': token
			}
		});	
	}

	function delete_menu(id) {
		confirm('Apakah anda yakin?');
		ajax_config();

		$.post(base_url+'/'+id,
		{
			_method: 'delete',
			_token: token
		},
		function(data, status){
			if (status) {
				location.reload(true);
			}else{
				alert('artikel gagal dihapus');
			}
		});
	}
</script>
@endsection