@extends('_layout/dashboard/index')
@section('page_title', 'Tambah Menu')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-theme">
			<div class="panel-heading">
				<h3 class="panel-title">Tambah Menu</h3>
			</div>
			<div class="panel-body">
				<form action="#">
					<div class="form-group">
						<label for="">Nama Menu</label>
						<input type="text" class="form-control" name="name" placeholder="nama menu">
					</div>
					<div class="form-group">
						<label for="">Deskripsi Menu</label>
						<textarea name="description" class="form-control" placeholder="deskripsi menu"></textarea>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="">Kategori Menu</label>
								<div class="input-group">
									<input type="text" class="form-control" name="category_id" placeholder="pilih kategori" readonly>
									<div class="span input-group-btn">
										<button class="btn btn-default" data-toggle="modal" data-target="#kategori" role="dialog" type="button">pilih</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="">Harga Menu</label>
								<div class="input-group">
									<span class="input-group-addon">Rp</span>
									<input type="text" class="form-control" name="price" placeholder="harga menu">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group break-20">
						<label for="">Unggah foto</label>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3">
								<input type="file" name="">
								<img src="{{URL::asset('images/blank-avatar.png')}}" alt="thumbnail" class="image-preview">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<input type="file" name="">
								<img src="{{URL::asset('images/blank-avatar.png')}}" alt="thumbnail" class="image-preview">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<input type="file" name="">
								<img src="{{URL::asset('images/blank-avatar.png')}}" alt="thumbnail" class="image-preview">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<input type="file" name="">
								<img src="{{URL::asset('images/blank-avatar.png')}}" alt="thumbnail" class="image-preview">
							</div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary"><i class="fa fa-save"></i> simpan</button>
						<button class="btn btn-default"><i class="fa fa-refresh"></i> bersihkan</button>
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
			<div class="modal-body">
				<form action="#">
					<div class="form-group">
						<input type="text" class="form-control" name="name" placeholder="nama kategori">
					</div>
					<div class="form-group">
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
						<button class="btn btn-primary btn-block">Tambah Kategori</button>
					</div>
				</form>
				<div class="table-responsive break-20">
					<table class="table table-stripped table-hover" id="tabel-kategori">
						<tbody>
							<tr>
								<td><i class="fa fa-circle" style="color:#4AC5AE"></i></td>
								<td>Makanan</td>
								<td class="text-right">
									<button class="btn btn-primary btn-xs" data-kategori="makanan" data-dismiss="modal" aria-label="Close">pilih kategori</button>
								</td>
							</tr>
							<tr>
								<td><i class="fa fa-circle" style="color:#337AB7"></i></td>
								<td>Minuman</td>
								<td class="text-right">
									<button class="btn btn-primary btn-xs" data-kategori="minuman" data-dismiss="modal" aria-label="Close">pilih kategori</button>
								</td>
							</tr>
							<tr>
								<td><i class="fa fa-circle" style="color:#FF7373"></i></td>
								<td>Desert</td>
								<td class="text-right">
									<button class="btn btn-primary btn-xs" data-kategori="desert" data-dismiss="modal" aria-label="Close">pilih kategori</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
<style>
	.image-preview{
		width: 150px;
		height: 150px;
		margin-top: 10px;
		object-fit: cover;
		object-position: center;
	}

	#tabel-kategori{
		border: 1px #CCC solid;
	}

	#tabel-kategori tbody td{
		border-top:1px #CCC solid;
		border-bottom:1px #CCC solid;
		vertical-align: middle;
	}

	#tabel-kategori tbody td:first-child{
		width: 10%;
		text-align: center;
	}

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

	$("#tabel-kategori > tbody > tr > td > button").click(function(){
		var data = $(this).data('kategori');
		$("input[name='category_id']").val(data);
	});
</script>
@endsection