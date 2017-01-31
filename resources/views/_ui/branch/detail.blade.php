@extends('_layout/dashboard/index')
@section('page_title', 'Detail Cabang')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Detail Cabang</h3>
			</div>
			<div class="panel-body">
				<form action="#">
					<div class="form-group">
						<label for="">Lokasi</label>
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<select name="" class="form-control">
									<option value="">Pilh Provinsi</option>
								</select>
							</div>
							<div class="col-xs-12 col-md-4">
								<select name="" class="form-control">
									<option value="">Pilih Kabupaten</option>
								</select>
							</div>
							<div class="col-xs-12 col-md-4">
								<select name="" class="form-control">
									<option value="">Pilih Kota</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Alamat</label>
						<textarea name="address" class="form-control" placeholder="alamat cabang"></textarea>
					</div>
					<div class="form-group">
						<label for="">Nomor Telpon</label>
						<input type="text" class="form-control" name="phone" placeholder="nomor telpon">
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="">Jam Buka</label>
								<input type="text" class="form-control" name="open_hours" placeholder="jam buka">
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="">Jam Tutup</label>
								<input type="text" class="form-control" name="close_hours" placeholder="jam tutup">
							</div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary"><i class="fa fa-save fa-fw"></i> perbaharui</button>
						<button class="btn btn-default"><i class="fa fa-refresh fa-fw"></i> batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection