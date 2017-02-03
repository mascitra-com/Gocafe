@extends('_layout/dashboard/index')
@section('page_title', 'Cafe Profile')

@section('content')
	<div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul style="margin: 0 1em">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
		<div class="col-xs-12 col-md-8">
			<div class="panel panel-default">
				<div class="panel-body">
					<h3 class="panel-title">Basic Info</h3>
					<form action="{{ URL('profile/cafe/'.(($cafe != NULL) ? $cafe->id : '')) }}" method="POST">
                        {{ ($cafe != NULL) ? method_field('PATCH') : ''}}
                        {{ csrf_field() }}
                        <div class="form-group">
							<label for="">Cafe Name</label>
							<input type="text" class="form-control" name="name" placeholder="Cafe Name" value="{{ ($cafe == NULL) ? old('name') : $cafe->name }}">
						</div>
						<div class="form-group">
							<label for="">Description</label>
							<textarea name="description" class="form-control" placeholder="Cafe Description">{{ ($cafe == NULL) ? old('description') : $cafe->description }}</textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save Basic Info</button>
							<button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Reset</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<h3 class="panel-title">Contact Info</h3>
                    <form action="{{ URL('profile/cafe/updateContact/'.($cafe == NULL ? '' : $cafe->id)) }}" method="POST">
                        {{ method_field('PATCH')}}
                        {{ csrf_field() }}
                        <div class="form-group">
							<label for=""><i class="fa fa-phone"></i> Phone Number</label>
							<input type="text" class="form-control" name="phone" placeholder="Phone Number" value="{{ ($cafe == NULL) ? old('phone') : $cafe->phone }}">
						</div>
						<div class="form-group">
							<label for=""><i class="fa fa-facebook"></i> Facebook</label>
							<input type="text" class="form-control" name="facebook" placeholder="Facebook" value="{{ ($cafe == NULL) ? old('facebook') : $cafe->facebook }}">
						</div>
						<div class="form-group">
							<label for=""><i class="fa fa-twitter"></i> Twitter</label>
							<input type="text" class="form-control" name="twitter" placeholder="Twitter" value="{{ ($cafe == NULL) ? old('twitter') : $cafe->twitter }}">
						</div>
						<div class="form-group">
							<label for=""><i class="fa fa-instagram"></i> Instagram</label>
							<input type="text" class="form-control" name="instagram" placeholder="Instagram" value="{{ ($cafe == NULL) ? old('instagram') : $cafe->instagram }}">
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save Contact Info</button>
							<button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Reset</button>
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