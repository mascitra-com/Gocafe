@extends('_layout/dashboard/index')
@section('page_title', 'Add new staff')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-plus"></i> Tambah Staff Baru</h3>
			</div>
			<div class="panel-body">
				<form action="#">
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<label for="">Nama Depan</label>
								<input type="text" class="form-control" name="first_name" placeholder="nama depan">
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label for="">Nama Belakang</label>
								<input type="text" class="form-control" name="last_name" placeholder="nama belakang">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Alamat</label>
						<textarea name="address" class="form-control" placeholder="alamat"></textarea>
					</div>
					<div class="form-group">
						<label for="">Tanggal Lahir</label>
						<div class="row">
							<div class="col-xs-3">
								<select name="birthdate_day" class="form-control">
									@for($i=1;$i<=31;$i++)
									<option value="{{$i}}"><?php echo str_pad($i,2,'0',STR_PAD_LEFT)?></option>
									@endfor
								</select>
							</div>
							<div class="col-xs-5">
								<select name="birthdate_month" class="form-control">
									@for($i=1;$i<=12;$i++)
									<option value="{{$i}}"><?php echo date('F', strtotime('1-'.$i.'-2000')) ?></option>
									@endfor
								</select>
							</div>
							<div class="col-xs-4">
								<select name="birthdate_year" class="form-control">
									@for($i=date('Y');$i>=1945;$i--)
									<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Jenis Kelamin</label><br>
						<label class="radio-inline">
							<input type="radio" name="gender" value="0" checked> Laki-laki
						</label>
						<label class="radio-inline">
							<input type="radio" name="gender" value="1"> Perempuan
						</label>
					</div>
					<div class="form-group">
						<label for="">Nomor Handphone</label>
						<div class="input-group">
							<span class="input-group-addon">+62</span>
							<input type="text" class="form-control" name="phone" placeholder="nomor handphone">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="">Cabang</label>
								<select name="branch_id" class="form-control">
									<option value="">Pilih cabang...</option>
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="">Posisi</label>
								<div class="input-group">
									<select class="form-control" name="position_id">
										<option value="">Pilih Posisi</option>
									</select>
									<span class="input-group-btn">
										<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#position">baru</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="break-30"></div>
					<div class="form-group">
						<button class="btn btn-primary"><i class="fa fa-save"></i> simpan</button>
						<button class="btn btn-default"><i class="fa fa-refresh"></i> batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate aut vitae, excepturi, ad molestias quisquam numquam inventore totam hic officia voluptate, veritatis esse facilis. Eius hic, nam. Libero, explicabo, nemo.</p>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="position">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Posisi</h4>
			</div>
			<div class="modal-body">
				<form action="#">
					<div class="form-group">
						<label for="">Nama Posisi</label>
						<input type="text" class="form-control" name="title" placeholder="nama posisi">
					</div>
					<div class="form-group">
						<label for="">Deskripsi</label>
						<textarea name="description" class="form-control" placeholder="deskripsi posisi"></textarea>
					</div>
					<div class="form-group">
						<label for="">Hak Akses</label>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu1
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu2
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu3
									</label>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu4
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu5
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Menu6
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="button">simpan</button>
						<button class="btn btn-default" type="reset">batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection