@extends('_layout/dashboard/index')
@section('page_title', 'Detail new staff')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-plus"></i> Detail Staff</h3>
			</div>
			<div class="panel-body">
				<form method="POST" action="{{ url('staff/'.$staff->id) }}">
				{{ method_field('PATCH') }}
				{{ csrf_field() }}
				<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" placeholder="email staff" value="{{ $staff->user->email }}">
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<label for="first_name">First Name</label>
								<input type="text" class="form-control" name="first_name" placeholder="first name" value="{{ $staff->first_name }}">
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label for="last_name">Last Name</label>
								<input type="text" class="form-control" name="last_name" placeholder="last name" value="{{ $staff->last_name }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<textarea name="address" class="form-control" placeholder="address">{{ $staff->address }}</textarea>
					</div>
					<div class="form-group">
						<label for="">Birth Date</label>
						<div class="row">
							<div class="col-xs-3">
								<select name="birthdate_day" class="form-control">
									@for($i=1;$i<=31;$i++)
									<option value="{{$i}}" @if($i == date('d' , strtotime($staff->birthdate))) {{ 'selected' }} @endif><?php echo str_pad($i,2,'0',STR_PAD_LEFT)?></option>
									@endfor
								</select>
							</div>
							<div class="col-xs-5">
								<select name="birthdate_month" class="form-control">
									@for($i=1;$i<=12;$i++)
									<option value="{{$i}}" @if($i == date('m' , strtotime($staff->birthdate))) {{ 'selected' }} @endif><?php echo date('F', strtotime('1-'.$i.'-2000')) ?></option>
									@endfor
								</select>
							</div>
							<div class="col-xs-4">
								<select name="birthdate_year" class="form-control">
									@for($i=date('Y');$i>=1945;$i--)
									<option value="{{$i}}" @if($i == date('Y' , strtotime($staff->birthdate))) {{ 'selected' }} @endif>{{$i}}</option>
									@endfor
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Gender</label><br>
						<label class="radio-inline">
							<input type="radio" name="gender" value="0" @if ($staff->gender === '0') {{ 'checked' }}@endif> Male
						</label>
						<label class="radio-inline">
							<input type="radio" name="gender" value="1" @if ($staff->gender === '1') {{ 'checked' }}@endif> Female
						</label>
					</div>
					<div class="form-group">
						<label for="">Phone Number</label>
						<div class="input-group">
							<span class="input-group-addon">+62</span>
							<input type="text" class="form-control" name="phone_input" placeholder="phone number" value="{{ substr($staff->phone, 3) }}">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="branch_id">Cabang</label>
								<select name="branch_id" class="form-control">
									@foreach ($branches as $branch)
									<option value="{{ $branch->id }}" @if($branch->id === $staff->branch_id ) {{ 'selected' }} @endif>{{ $branch->id }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="position_id">Posisi</label>
								<div class="input-group">
									<select class="form-control" name="position_id">
										@foreach ($positions as $position)
										<option value="{{ $position->id }}" @if($position->id === $staff->position_id ) {{ 'selected' }} @endif>{{ $position->title }}</option>
										@endforeach
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
						<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> save changes</button>
						<button class="btn btn-default"><i class="fa fa-refresh"></i> reset</button>
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