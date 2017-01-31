<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="{{URL::asset('plugins/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-sign.css')}}">
	<link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-helper.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400" rel="stylesheet"> 
</head>
<body>
	<div class="container-fluid">
		<div class="row form-big" id="form-container">
			<div class="col-xs-12 col-sm-6 col-md-8 background-img image-fade" id="form-left" data-image="{{URL::asset('images/bg4.png')}}">
				<h2>DIGITAL CAFE<br>MARKETPLACE</h2>
				<p class="text-size-20">Your perfect place to manage and promote<br>your favorite Cafe</p>
				<div class="break-50"></div>
				<button class="btn btn-default btn-round">daftar sekarang!</button>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4" id="form-right">
				<h3 class="form-title">MEMBER LOGIN</h3>
				<form action="#" method="post">
					<div class="form-group">
						<label for="">email</label>
						<input type="text" class="form-control" placeholder="email">
					</div>
					<div class="form-group">
						<label for="">password</label>
						<input type="password" class="form-control" placeholder="password">
					</div>
					<div class="form-group">
						<div class="btn-group btn-group-justified">
							<div class="btn-group" role="group">
								<button class="btn btn-primary btn-round">login</button>
							</div>
							<div class="btn-group" role="group">
								<button class="btn btn-warning btn-round">reset</button>
							</div>
						</div>
					</div>
					<div class="form-roup">
						<a href="#" class="link">lupa password?</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<script src="{{URL::asset('plugins/jquery/jquery-3.1.1.min.js')}}"></script>
<script src="{{URL::asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('plugins/theme/js/theme-helper.js')}}"></script>
</html>