@extends('_layout/dashboard/index')
@section('page_title', 'Owner Account')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Ganti Email</h3>
			</div>
			<div class="panel-body">
				<form action="#">
					<div class="form-group">
						<label for="#">Email Sekarang</label>
						<div class="input-group">
							<input type="email" class="form-control" name="email" placeholder="email" value="ainul@gmail.com">
							<span class="input-group-addon"><i class="fa fa-check"></i></span>
						</div>
					</div>
					<div class="form-group">
						<label for="#">Email Baru</label>
						<input type="email" class="form-control" name="email_new" placeholder="email baru">
					</div>
					<div class="form-group">
						<label for="#">Tulis Ulang Email</label>
						<input type="email" class="form-control" name="email_new_2" placeholder="tulis ulang email baru">
					</div>
					<div class="form-group">
						<button class="btn btn-primary"><i class="fa fa-save"></i> Perbaharui</button>
						<button class="btn btn-default"><i class="fa fa-refresh"></i> Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Ganti Password</h3>
			</div>
			<div class="panel-body">
				<form action="#">
					<div class="form-group">
						<label for="#">Password Sekarang</label>
						<input type="password" class="form-control" name="password" placeholder="password">
					</div>
					<div class="form-group">
						<label for="#">Password Baru</label>
						<input type="password" class="form-control" name="password_new" placeholder="password baru">
					</div>
					<div class="form-group">
						<label for="#">Tulis Ulang Password</label>
						<input type="password" class="form-control" name="password_new_2" placeholder="tulis ulang password baru">
					</div>
					<div class="form-group">
						<button class="btn btn-primary"><i class="fa fa-save"></i> Perbaharui</button>
						<button class="btn btn-default"><i class="fa fa-refresh"></i> Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection