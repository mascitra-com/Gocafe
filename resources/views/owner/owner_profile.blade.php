@extends('_layout/dashboard/index')
@section('page_title', 'Owner Profile')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">var base_url = '{{ url()->full() }}'</script>
@stop

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-3">
		<div class="panel panel-default">
			<div class="panel-body box-center">
				<h4 class="panel-title">Profile Picture</h4>
				<img src="{{route('getAvatar')}}" class="image-fit img-circle" width="80%" alt="foto">
				<div class="break-10"></div>
				<h4 class="text-quadruple">{{ $profile->first_name.' '.$profile->last_name }}</h4>
				<div class="break-10"></div>
				<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#upload">Change Profile Picture</button>
				<button class="btn btn-default btn-xs">Delete</button>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-5">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4 class="panel-title">Personal Info</h4>
				<form action="{{ url('profile/personal/'.$profile->id) }}" method="POST">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="first_name" class="text-quadruple">First Name</label>
								<input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ $profile->first_name }}">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="last_name" class="text-quadruple">Last Name</label>
								<input type="text" name="last_name" class="form-control" placeholder="Last Name" value={{ $profile->last_name }}>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="address" class="text-quadruple">Address</label>
						<textarea name="address" class="form-control" placeholder="Address">{{ $profile->address }}</textarea>
					</div>
					<div class="form-group">
						<label for="birthdate" class="text-quadruple">Birth Date</label>
						<div class="row">
							<div class="col-xs-3">
								<select name="birthdate_day" class="form-control">
									@for($i=1;$i<=31;$i++)
									<option value="{{$i}}" @if($i == date('d' , strtotime($profile->birthdate))) {{ 'selected' }} @endif><?php echo str_pad($i,2,'0',STR_PAD_LEFT)?></option>
									@endfor
								</select>
							</div>
							<div class="col-xs-5">
								<select name="birthdate_month" class="form-control">
									@for($i=1;$i<=12;$i++)
									<option value="{{$i}}" @if($i == date('m' , strtotime($profile->birthdate))) {{ 'selected' }} @endif><?php echo date('F', strtotime('1-'.$i.'-2000')) ?></option>
									@endfor
								</select>
							</div>
							<div class="col-xs-4">
								<select name="birthdate_year" class="form-control">
									@for($i=date('Y');$i>=1945;$i--)
									<option value="{{$i}}" @if($i == date('Y' , strtotime($profile->birthdate))) {{ 'selected' }} @endif>{{$i}}</option>
									@endfor
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="gender" class="text-quadruple">Gender</label><br>
						<label class="radio-inline">
							<input type="radio" name="gender" value="0" @if ($profile->gender === '0') {{ 'checked' }}@endif> Male
						</label>
						<label class="radio-inline">
							<input type="radio" name="gender" value="1" @if ($profile->gender === '1') {{ 'checked' }}@endif> Female
						</label>
					</div>
					<div class="break-50"></div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save Changes</button>
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
				<form action="{{ url('profile/contact/'.$profile->id) }}" method="POST">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					<div class="form-group">
						<label for="email" class="text-quadruple">Public Email</label>
						<input type="text" class="form-control" name="email" placeholder="Email Address" value={{ $profile->email }}>
					</div>
					<div class="form-group">
						<label for="phone" class="text-quadruple">Phone Number</label>
						<input type="text" class="form-control" name="phone" placeholder="Phone Number" value= {{ $profile->phone }}>
					</div>
					<div class="form-group">
						<label for="facebook" class="text-quadruple">Facebook</label>
						<input type="text" class="form-control" name="facebook" placeholder="Facebook (optional)" value= {{ $profile->facebook }}>
					</div>
					<div class="form-group">
						<label for="twitter" class="text-quadruple">Twitter</label>
						<input type="text" class="form-control" name="twitter" placeholder="Twitter (optional)" value= {{ $profile->twitter }}>
					</div>
					<div class="form-group">
						<label for="instagram" class="text-quadruple">Instagram</label>
						<input type="text" class="form-control" name="instagram" placeholder="Instagram (optional)" value= {{ $profile->instagram }}>
					</div>
					<div class="break-20"></div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save Changes</button>
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
				<form id="updateAvatar">
					<div class="form-group">
						<label for="avatar" class="text-quadruple"> Pilih file</label>
						<input type="file" name="avatar" id="avatar">
					</div>
					<button type="button" class="btn btn-primary" onclick="change_avatar('{{ encrypt(Auth::user()->id) }}')" id="btn-avt">Upload</button>
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

@section('javascripts')
<script type="text/javascript" src="{{URL::asset('js/Profile/profile.js')}}"></script>
@stop