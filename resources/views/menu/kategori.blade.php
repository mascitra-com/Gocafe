@extends('_layout/dashboard/index')
@section('page_title', 'Kategori Menu')

@section('content')
<div class="row">
	@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
	@endif
	<div class="col-xs-12 col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Data Kategori</h3>
			</div>
			<div class="panel-body table-responsive table-full">
				<table class="table table-hover table-stripped table-bordered">
					<thead>
						<tr>
							<th class="text-center">ID</th>
							<th>Nama Kategori</th>
							<th class="text-center">Warna Label</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categories as $category)
						<tr>
							<td class="text-center">{{ $category->id }}</td>
							<td>{{ $category->name }}</td>
							<td class="text-center"><span class="label" style="background-color: {{ $category->colour }}">{{ $category->colour }}</span></td>
							<td class="text-center">
								<button class="btn btn-default btn-xs btn-edit" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-colour = {{ $category->colour }}><i class="fa fa-pencil"></i></button>
								<button href="#" class="btn btn-default btn-xs" onclick="delete_category('{{ $category->id }}')"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
				<span class="text-grey">last edited by admin 01-11-2018 16:30</span>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-4">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Tambah Kategori</h3>
			</div>
			<div class="panel-body">
				<form action="{{ url('categories') }}" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="">ID Kategori</label>
						<input type="text" class="form-control" name="id" placeholder="ID Kategori" value="{{ $categoryID }}" readonly>
					</div>
					<div class="form-group">
						<label for="">Nama Kategori</label>
						<input type="text" class="form-control" name="name" placeholder="Nama Kategori" list="recommended-category">
						<datalist id="recommended-category">
                            @foreach($recommendedCat as $recommend)
                                <option value="{{ $recommend->name }}">
                            @endforeach
                        </datalist>
					</div>
					<div class="form-group">
						<label for="">Warna Label</label>
						<select name="colour" class="form-control" id="category_colour">
							<option value="" class="option-blank">Pilih warna...</option>
							<option value="#b71c1c" class="option-red">Merah</option>
							<option value="#1976d2" class="option-blue">Biru</option>
							<option value="#2e7d32" class="option-green">Hijau</option>
							<option value="#f9a825" class="option-yellow">Kuning</option>
							<option value="#7b1fa2" class="option-purple">Ungu</option>
							<option value="#ef6c00" class="option-orange">Jingga</option>
							<option value="#c2185b" class="option-pink">Merah Muda</option>
							<option value="#9e9e9e" class="option-grey">Abu-Abu</option>
							<option value="#212121" class="option-black">Hitam</option>
						</select>
					</div>
					<div class="form-group">
						<button class="btn btn-primary">Tambah</button>
						<button class="btn btn-default" type="reset">Bersihkan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="kategori">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Pilih kategori</h4>
			</div>
			<form action="{{ url('categories') }}" method="POST" id="updateForm" class="form">
				{{ csrf_field() }}
				<div class="modal-body">
					<input type="hidden" name="_method" value="PATCH">
					<div class="form-group">
						<input type="text" class="form-control" name="name" placeholder="Nama Kategori" id="category_name">
					</div>
					<div class="form-group">
						<select name="colour" class="form-control" id="category_colour">
							<option value="" class="option-blank">Pilih warna...</option>
							<option value="#b71c1c" class="option-red">Merah</option>
							<option value="#1976d2" class="option-blue">Biru</option>
							<option value="#2e7d32" class="option-green">Hijau</option>
							<option value="#f9a825" class="option-yellow">Kuning</option>
							<option value="#7b1fa2" class="option-purple">Ungu</option>
							<option value="#ef6c00" class="option-orange">Jingga</option>
							<option value="#c2185b" class="option-pink">Merah Muda</option>
							<option value="#9e9e9e" class="option-grey">Abu-Abu</option>
							<option value="#212121" class="option-black">Hitam</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary center-block">Update Kategori</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
@endsection

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
	select option{
		padding: 5px;
		font-weight: bold;
		color: #FFF;
	}

	.option-blank{background-color: #fafafa;color: #333}
	.option-red{background-color: #b71c1c;}
	.option-blue{background-color: #1976d2;}
	.option-green{background-color: #2e7d32;}
	.option-yellow{background-color: #f9a825;}
	.option-purple{background-color: #7b1fa2;}
	.option-orange{background-color: #ef6c00;}
	.option-pink{background-color: #c2185b;}
	.option-grey{background-color: #9e9e9e;}
	.option-black{background-color: #212121;}
</style>
@endsection

@section('javascripts')
<script type="text/javascript">var base_url = '{{ url()->full() }}'</script>
<script type="text/javascript" src="{{URL::asset('js/Category_Menu/category_menu.js')}}"></script>
<script>
	$("select[name='colour']").change(function(){
		if ($(this).val() != ""){
			$(this).css('background-color', $(this).val()).css('color', '#FFF');
		}else{
			$(this).css('background-color', '#FFF').css('color', '#333');
		}
	});

	$(".btn-edit").click(function(){
		$("#updateForm").attr("action", "/categories/" + $(this).data('id'));
		$("#kategori .form input[name='name']").val($(this).data('name'));
		$("#category_colour").css("background-color",$(this).data('colour')).css("color", "#FFF");
		$("#kategori .form option[value='"+ $(this).data('colour') +"']").prop('selected', true);
		$('#kategori').modal('show');
	});

	function ajax_config() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': token
			}
		});	
	}

	function delete_category(id) {
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
				alert('kategori gagal dihapus');
			}
		});
	}
</script>
@endsection