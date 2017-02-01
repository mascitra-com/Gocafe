@extends('_layout/dashboard/index')
@section('page_title', 'Owner Profile')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-3">
		<div class="panel panel-default">
			<div class="panel-body box-center">
				<h4 class="panel-title">Profile Picture</h4>
				<img src="{{URL::asset('images/blank-avatar.png')}}" class="image-fit img-circle" width="80%" alt="foto">
				<div class="break-10"></div>
				<h4>Adrew Andersons</h4>
				<div class="break-10"></div>
				<button class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#upload">Change Profile Picture</button>
				<div class="break-5"></div>
				<button class="btn btn-default btn-xs btn-round">Delete</button>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-5">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4 class="panel-title">Personal Info</h4>
				<form action="#">
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="">First Name</label>
								<input type="text" name="first_name" class="form-control" placeholder="first name">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="">Last Name</label>
								<input type="text" name="last_name" class="form-control" placeholder="Last name">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Address</label>
						<textarea name="address" class="form-control" placeholder="address"></textarea>
					</div>
					<div class="form-group">
						<label for="">Birth Date</label>
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
						<label for="">Gender</label><br>
						<label class="radio-inline">
							<input type="radio" name="gender" value="0"> Male
						</label>
						<label class="radio-inline">
							<input type="radio" name="gender" value="1"> Female
						</label>
					</div>
					<div class="break-50"></div>
					<div class="form-group">
						<button class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
						<button class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4 class="panel-title">Contact Info</h4>
				<form action="#">
					<div class="form-group">
						<label for="">Email</label>
						<input type="text" class="form-control" name="email" placeholder="email address">
					</div>
					<div class="form-group">
						<label for="">Phone Number</label>
						<input type="text" class="form-control" name="phone" placeholder="phone number">
					</div>
					<div class="form-group">
						<label for="">Facebook</label>
						<input type="text" class="form-control" name="facebook" placeholder="facebook (optional)">
					</div>
					<div class="form-group">
						<label for="">Twitter</label>
						<input type="text" class="form-control" name="twitter" placeholder="twitter (optional)">
					</div>
					<div class="form-group">
						<label for="">Instagram</label>
						<input type="text" class="form-control" name="instagram" placeholder="instagram (optional)">
					</div>
					<div class="break-20"></div>
					<div class="form-group">
						<button class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
						<button class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="upload">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Upload Foto</h4>
			</div>
			<div class="modal-body">
				<form action="#">
					<div class="form-group">
						<label for=""> Pilih file</label>
						<input type="file">
					</div>
					<button type="button" class="btn btn-primary">Upload</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
<style>
	.row > [class*=col-]{
		padding-left: 5px;
		padding-right: 5px;
	}

	.panel{
		padding-left: 10px;
		padding-right: 10px;
	}

	.panel-title{
		margin-bottom: 20px;
	}

	.box-center{
		display: flex;
		flex-direction: column;
		align-items: center;
	}
</style>
@endsection