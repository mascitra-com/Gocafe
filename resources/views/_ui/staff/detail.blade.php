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
				<form action="#">
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<label for="">First Name</label>
								<input type="text" class="form-control" name="first_name" placeholder="first name">
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label for="">Last Name</label>
								<input type="text" class="form-control" name="last_name" placeholder="last name">
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
					<div class="form-group">
						<label for="">Phone Number</label>
						<div class="input-group">
							<span class="input-group-addon">+62</span>
							<input type="text" class="form-control" name="phone" placeholder="phone number">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="">Branch</label>
								<select name="branch_id" class="form-control">
									<option value="">Select Branch...</option>
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="">Position</label>
								<select name="position_id" class="form-control">
									<option value="">Select Position...</option>
								</select>
							</div>
						</div>
					</div>
					<div class="break-30"></div>
					<div class="form-group">
						<button class="btn btn-primary"><i class="fa fa-save"></i> save changes</button>
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