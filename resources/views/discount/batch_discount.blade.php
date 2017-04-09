@extends('_layout/dashboard/index')
@section('page_title', 'Batch Manage Discount')

@section('content')
<form>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-theme">
				<div class="panel-heading">
					<h3 class="panel-title pull-left">Batch Manage Discount</h3>
					<div class="btn-group pull-right">
						<button class="btn btn-default" type="submit"><i class="fa fa-check text-green"></i> Save</button>
						<button class="btn btn-default btn-remove-all" type="button"><i class="fa fa-times text-red"></i> Clear</button>
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
							<input type="text" id="menu" list="menu-list" class="form-control" placeholder="search menu/package" autocomplete="off">
							<datalist id="menu-list">
								@foreach($menus as $menu)
								<option value="{{ $menu->name . ' | ' . $menu->id }}"/>
									@endforeach
									@foreach($packages as $package)
									<option value="{{ $package->name . ' | ' . $package->id }}"/>
										@endforeach
									</datalist>
									<span class="input-group-btn"><button class="btn btn-default btn-tambah" type="button">Add</button></span>
								</div>
							</div>
							<div class="tabel-responsive">
								<table class="table table-striped table-menu">
									<tbody></tbody>
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
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<script type="text/javascript">var base_url = '{{ url()->full() }}'</script>
		<style>
			td{
				vertical-align: middle!important;
			}
			td, td *{
				font-size: 12pt;
			}
		</style>
		@endsection

		@section('javascripts')
		<script type="text/javascript">
			var data = [];
			var menu_id = [];

			$('.btn-tambah').click(function(){
				$input = $("input[list='menu-list']").val();
				if ($input) {
					var id = $input.split("| ");
					data.push($input);
					menu_id.push(id[1]);
					refresh();
				}else{
					alert('Choose menu/package!');
				}
			});

			$('.btn-remove-all').click(function(){
				data = [];
				menu_id = [];
				$(".table-menu > tbody").empty();
			});

			$("tbody").delegate('.btn-remove','click', function(){
				console.log(data);
				console.log(data.indexOf('0'));
				var ind = data.indexOf($(this).data('index'));
				if (ind > -1) {
					data.splice(ind, 1);
				}
				refresh();
			});

			function refresh() {
				$(".table-menu > tbody").empty();
				data.forEach(function (item, index) {
					var html = "<tr><td class='text-center' width='8%'>"+ (index + 1) +"</td>";
					html+= "<td>"+ item + "</td>";
					html+= "<td><span class='label label-success'>"+ "Rp 10.000" + "</span></td>"
					html+= "<td class='text-right btn-remove'><a href='#' class='btn btn-default'><i class='fa fa-ellipsis-h'></i></a>"
					html+= "<button class='btn btn-default' type='button' data-index='"+ (index) +"'><i class='fa fa-times text-red'></i></button></td></tr>"
					$(".table-menu > tbody").append(html);
				});
			}

			$('form').on('submit', function(e){
				e.preventDefault();
				$.post("{{url('batch_discount')}}",
				{
					_method: 'POST',
					_token: $('meta[name="csrf-token"]').attr('content'),
					discount: $("input[name='discount']").val(),
					menus_id: menu_id
				},
				function(data, status){
                    if (status) {
                        alert('Input Diskon Berhasil');
                        window.location.href = "{{ url('batch_discount') }}";
                    }else{
						alert('Input paket Gagal');
					}
				});
			});
		</script>
		@stop