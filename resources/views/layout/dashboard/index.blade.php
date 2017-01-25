<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('page_title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{URL::asset('plugins/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('plugins/fontawesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-dashboard.css')}}">
	<link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-helper.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400" rel="stylesheet">
	@yield('styles')
</head>
<body>
	<div class="container-fluid" id="wrapper">
		<div id="nav-side">
			<div id="nav-side-wrapper">
				<div id="nav-side-thumbnail" class="hidden-sm">
					<h3><span class="text-black">GO</span>CAFE!</h3>
				</div>
				<ul class="nav">
					<li class="nav-close"><a href="#"><i class="fa fa-fw fa-close"></i></a></li>
					<li class="nav-active"><a href="#"><i class="fa fa-fw fa-home"></i><span class="hidden-sm">Dashboard</span></a></li>
					<li class="nav-title">Information</li>
					<li><a href="#"><i class="fa fa-fw fa-user"></i><span class="hidden-sm">Owner Profile</span></a></li>
					<li><a href="#"><i class="fa fa-fw fa-user"></i><span class="hidden-sm">Cafe Profile</span></a></li>
					<li class="nav-title">Staff</li>
					<li><a href="#"><i class="fa fa-fw fa-users"></i><span class="hidden-sm">Staff Management</span></a></li>

					<!-- <li>
						<a href="#menu-dropdown" data-toggle="collapse" aria-controls="collapse-post"><i class="fa fa-fw fa-bars"></i><span class="hidden-sm">Dropdown</span></a>
						<ul class="collapse collapseable" id="menu-dropdown">
							<li><a href="#"><i class="fa fa-fw fa-bars"></i><span class="hidden-sm">Menu1</span></a></li>
							<li><a href="#"><i class="fa fa-fw fa-bars"></i><span class="hidden-sm">Menu1</span></a></li>
						</ul>
					</li> -->
				</ul>
			</div>
		</div>
		<div id="main-panel">
			<nav class="navbar navbar-default" id="nav-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#" id="btn-menu" data-menu="#nav-side"><i class="fa fa-bars btn-responsive"></i>Dashboard</a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="#"><i class="fa fa-fw fa-cog"></i></a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-user"></i><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
								</ul>
							</li>
							<li><a href="#"><i class="fa fa-fw fa-power-off"></i></a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
			<div id="content">
				<div class="container-fluid">
					@yield('content')
				</div>
			</div>
		</div>
	</div>
</body>
<script src="{{URL::asset('plugins/jquery/jquery-3.1.1.min.js')}}"></script>
<script src="{{URL::asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/theme-dashboard.js')}}"></script>
<script src="{{URL::asset('js/theme-helper.js')}}"></script>
@yield('javascripts')
</html>