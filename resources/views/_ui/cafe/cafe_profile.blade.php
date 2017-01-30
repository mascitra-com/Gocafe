@extends('_layout/dashboard/index')
@section('page_title', 'Owner Profile')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-8">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3 class="panel-title">Basic Info</h3>
				<form action="#">
					<div class="form-group">
						<label for="">Cafe Name</label>
						<input type="text" class="form-control" name="name" placeholder="cafe name">
					</div>
					<div class="form-group">
						<label for="">Description</label>
						<textarea name="description" class="form-control" placeholder="cafe description"></textarea>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<label for="">Opening Hours</label>
								<input type="text" class="form-control" name="open_hours" placeholder="open hours">
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label for="">Closing Hours</label>
								<input type="text" class="form-control" name="close_hours" placeholder="close hours">
							</div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> save changes</button>
						<button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3 class="panel-title">Contact Info</h3>
				<form action="#">
					<div class="form-group">
						<label for=""><i class="fa fa-phone"></i> Phone Number</label>
						<input type="text" class="form-control" name="phone" placeholder="phone number">
					</div>
					<div class="form-group">
						<label for=""><i class="fa fa-facebook"></i> Facebook</label>
						<input type="text" class="form-control" name="facebook" placeholder="facebook">
					</div>
					<div class="form-group">
						<label for=""><i class="fa fa-twitter"></i> Twitter</label>
						<input type="text" class="form-control" name="twitter" placeholder="twitter">
					</div>
					<div class="form-group">
						<label for=""><i class="fa fa-instagram"></i> Instagram</label>
						<input type="text" class="form-control" name="instagram" placeholder="instagram">
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> save changes</button>
						<button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
<style>
	.container-fluid > .row > [class*=col-]{
		padding-left: 5px;
		padding-right: 5px;
	}

	.panel{
		padding-left: 10px;
		padding-right: 10px;
	}

	.panel-title{
		color:#AAA;
		margin-bottom: 20px;
	}

	.btn-xs{
		padding: 3px 10px;
	}

	.radio-inline{
		border: 1px #AAA solid;
		border-radius: 10px;
		padding: 3px 10px 3px 25px;
	}
</style>
@endsection