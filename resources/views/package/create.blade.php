@extends('_layout/dashboard/index')
@section('page_title', 'Create Package')

@section('content')
<form>
	<div class="row">
		<div class="col-xs-12 col-md-4">
			<div class="panel panel-theme">
				<div class="panel-heading">
					<h3 class="panel-title">Package Info</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" name="name" placeholder="package name" required/>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control" name="description" placeholder="package description"></textarea>
					</div>
					<div class="form-group">
						<label for="">Price</label>
						<input type="number" name="price" min="0" class="form-control" placeholder="price" required/>
					</div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-primary" type="submit">Save</button>
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
					<table class="table table-striped table-hover table-menu">
						<thead>
							<td colspan="4">
								<div class="input-group">
									<input type="text" list="data-list" class="form-control" placeholder="search menu" autocomplete="off">
									<datalist id="data-list">
										@foreach($menus as $menu)
										<option value="{{ $menu->name . '|' . $menu->id }}" />
											@endforeach
										</datalist>
										<span class="input-group-btn">
											<button class="btn btn-default btn-tambah" type="button"><i class="fa fa-plus"></i></button>
										</span>
									</div>
								</td>
							</thead>
							<tbody>
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
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="text/javascript">var base_url = '{{ url()->full() }}'</script>
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

	@section('javascripts')
	<script type="text/javascript">
		var data = [];
		var menu_id = [];

		$('.btn-tambah').click(function(){
			$input = $("input[list='data-list']").val();
			if ($input) {
				var id = $input.split("|");
				data.push($input);
				menu_id.push(id[1]);
				refresh();
			}else{
				alert('Pilih menu terlebih dahulu!');
			}
		});

		$("tbody").delegate('.btn-remove','click', function(){
			var ind = data.indexOf($(this).data('index'));
			if (ind > -1) {
				data.splice(ind, 1);
			}
			refresh();
		});

		function refresh() {
			var asset = "{{URL::asset('images/blank-avatar.png')}}";
			$(".table-menu > tbody").empty();
			data.forEach(function (item, index) {
				var html = "<tr><td><img src='"+ "{{URL::asset('images/blank-avatar.png')}}" +"' alt='thumbnail' class='menu-thumbnail'></td>";
				html+= "<td><h4>"+ item +"</h4><p>"+ "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, deleniti." +"</p></td>";
				html+= "<td><span class='label label-success'>"+ "Rp 10.000" + "</span></td>"
				html+= "<td class='text-nowrap btn-remove'><button class='btn btn-default btn-xs' data-index='" + (index) + "' type='button'><i class='fa fa-ellipsis-h'></i></button>";
				html+= "<button class='btn btn-default btn-xs' type='button'><i class='fa fa-times text-red'></i></button></td></tr>";
				$(".table-menu > tbody").append(html);
			});
		}

		$('form').on('submit', function(e){
			e.preventDefault();
			$.post("{{url('packages')}}",
			{
				_method: 'POST',
				_token: $('meta[name="csrf-token"]').attr('content'),
				name: $("input[name='name']").val(),
				description: $("textarea[name='description']").val(),
				price: $("input[name='price']").val(),
				menus_id: menu_id
			},
			function(data, status){
				if (status) {
                    alert('Input paket Berhasil');
                    window.location.href = "{{ url('packages') }}";
				}else{
					alert('Input paket gagal');
				}
			});
		});
	</script>
	@stop