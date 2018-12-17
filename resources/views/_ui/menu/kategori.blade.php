@extends('_layout/dashboard/index')
@section('page_title', 'Kategori Menu')

@section('content')
<div class="row">
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
						<tr>
							<td class="text-center">KAT01</td>
							<td>Makanan</td>
							<td class="text-center"><span class="label" style="background-color: red">Merah</span></td>
							<td class="text-center">
								<button class="btn btn-default btn-xs" data-id="" data-name="" data-colour=""><i class="fa fa-pencil"></i></button>
								<a href="#" class="btn btn-default btn-xs" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
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
				<form action="#">
					<div class="form-group">
						<label for="">ID Kategori</label>
						<input type="text" class="form-control" name="id" placeholder="id kategori" readonly>
					</div>
					<div class="form-group">
						<label for="">Nama Kategori</label>
						<input type="text" class="form-control" name="name" placeholder="nama kategori">
					</div>
					<div class="form-group">
						<label for="">Warna Label</label>
						<select name="color" class="form-control">
							<option value="" class="option-blank" selected>Pilih warna...</option>
							<option value="#C52B15" class="option-merah">Merah</option>
							<option value="#337AB7" class="option-biru">Biru</option>
							<option value="#4AC5AE" class="option-hijau">Hijau</option>
							<option value="#F7C96B" class="option-kuning">Kuning</option>
							<option value="#BF73FF" class="option-ungu">Ungu</option>
							<option value="#EF6C40" class="option-jingga">Jingga</option>
							<option value="#FF7373" class="option-merahmuda">Merah Muda</option>
							<option value="#CCC" class="option-abu">Abu-Abu</option>
							<option value="#333" class="option-hitam">Hitam</option>
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

@section('styles')
<style>
	select option{
		padding: 5px;
		font-weight: bold;
		color: #FFF;
	}

	.option-blank{background-color: #FFF;color: #333}
	.option-merah{background-color: #C52B15;}
	.option-biru{background-color: #337AB7;}
	.option-hijau{background-color: #4AC5AE;}
	.option-kuning{background-color: #F7C96B;}
	.option-ungu{background-color: #BF73FF;}
	.option-jingga{background-color: #EF6C40;}
	.option-merahmuda{background-color: #FF7373;}
	.option-abu{background-color: #CCC;}
	.option-hitam{background-color: #333;}
</style>
@endsection

@section('javascripts')
<script>
	$("select[name='color']").change(function(){
		if ($(this).val() != ""){
			$(this).css('background-color', $(this).val()).css('color', '#FFF');
		}else{
			$(this).css('background-color', '#FFF').css('color', '#333');
		}
	});
</script>
@endsection