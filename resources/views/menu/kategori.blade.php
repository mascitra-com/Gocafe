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
				<span class="text-grey">last edited by admin 12-02-2017 16:30</span>
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
						<input type="text" class="form-control" name="name" placeholder="Nama Kategori">
					</div>
					<div class="form-group">
						<label for="">Warna Label</label>
						<select name="colour" class="form-control">
							<option value="" class="option-blank" selected>Pilih Warna...</option>
							<option value="#C52B15" class="option-red">Merah</option>
							<option value="#337AB7" class="option-blue">Biru</option>
							<option value="#4AC5AE" class="option-green">Hijau</option>
							<option value="#F7C96B" class="option-yellow">Kuning</option>
							<option value="#BF73FF" class="option-purple">Ungu</option>
							<option value="#EF6C40" class="option-orange">Jingga</option>
							<option value="#FF7373" class="option-pink">Merah Muda</option>
							<option value="#CCC" class="option-grey">Abu-Abu</option>
							<option value="#333" class="option-black">Hitam</option>
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
							<option value="#C52B15" class="option-red">Merah</option>
							<option value="#337AB7" class="option-blue">Biru</option>
							<option value="#4AC5AE" class="option-green">Hijau</option>
							<option value="#F7C96B" class="option-yellow">Kuning</option>
							<option value="#BF73FF" class="option-purple">Ungu</option>
							<option value="#EF6C40" class="option-orange">Jingga</option>
							<option value="#FF7373" class="option-pink">Merah Muda</option>
							<option value="#CCC" class="option-grey">Abu-Abu</option>
							<option value="#333" class="option-black">Hitam</option>
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

	.option-blank{background-color: #FFF;color: #333}
	.option-red{background-color: #C52B15;}
	.option-blue{background-color: #337AB7;}
	.option-green{background-color: #4AC5AE;}
	.option-yellow{background-color: #F7C96B;}
	.option-purple{background-color: #BF73FF;}
	.option-orange{background-color: #EF6C40;}
	.option-pink{background-color: #FF7373;}
	.option-grey{background-color: #CCC;}
	.option-black{background-color: #333;}
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