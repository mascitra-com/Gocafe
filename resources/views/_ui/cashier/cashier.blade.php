<?php 
# FOR TEST ONLY
$menu = array(array(3,'Nasi Goreng Pedas', '30.000'),array(1, 'Ayam Panggang', '45.000'),array(5, 'Jus Jeruk', '25.000'),array(10, 'Kerupuk Putih', '10.000'),);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cashier</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{URL::asset('plugins/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('plugins/fontawesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-cashier.css')}}">
	<link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-helper.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400" rel="stylesheet">
</head>
<body>
	<div class="container-fluid" id="wrapper">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-3" id="detail">
				<div class="title-text">
					<h2><span class="text-orange">GOCAFE</span>CASHIER</h2>
				</div>
				<table class="table table-noborder">
					<!-- TABLE -->
					<tr>
						<td><button class="btn btn-xs btn-warning" type="button">Table</button></td>
						<td class="text-right text-orange">MEJA 01</td>
					</tr>
					<tr><td colspan="2"><div class="line line-fade"></div></td></tr>
					<!-- Order -->
					<tr>
						<td colspan="2">
							<span>Order</span>
							<table class="table table-noborder" id="menu-list">
								@foreach($menu as $item)
								<tr>
									<td><span class="label label-orange">{{str_pad($item[0],2,'0',STR_PAD_LEFT)}}</span></td>
									<td>{{$item[1]}}</td>
									<td class="text-right text-orange">{{$item[2]}}</td>
								</tr>
								@endforeach
							</table>
						</td>
					</tr>
					<tr><td colspan="2"><div class="line line-fade"></div></td></tr>
					<!-- PROMO -->
					<tr>
						<td><button class="btn btn-xs btn-warning" type="button">Promo/Discount</button></td>
						<td class="text-right text-orange">Promo Lebaran<br>(-10%)</td>
					</tr>
					<tr><td colspan="2"><div class="line line-fade"></div></td></tr>
					<!-- TOTAL -->
					<tr>
						<td colspan="2">
							<table class="table table-noborder" id="menu-list">
								<tr>
									<td>Total Order</td>
									<td class="text-right text-orange">110.000</td>
								</tr>
								<tr>
									<td>Discount (10%)</td>
									<td class="text-right text-orange">-11.000</td>
								</tr>
								<tr>
									<td>Total</td>
									<td class="text-right text-orange">101.750</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td colspan="2"><div class="line line-fade"></div></td></tr>
					<tr>
						<td colspan="2">
							<div class="btn-group btn-group-justified">
								<div class="btn-group">
									<button class="btn btn-warning"><i class="fa fa-check"></i> Finish Order</button>
								</div>
								<div class="btn-group">
									<button class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9" id="menu">
				<!-- TOPBAR -->
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#">GOCAFE</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="active"><a href="#">MENU</a></li>
								<li><a href="#">PACKAGE</a></li>
							</ul>
							<form class="navbar-form navbar-right">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Search">
								</div>
								<button type="submit" class="btn btn-default" type="button">Search</button>
							</form>
						</div>
					</div>
				</nav>
				<div class="row">
					@for($i=0; $i < 10; $i++)
					<div class="col-xs-12 col-sm-4 col-lg-3">
						<div class="panel panel-menu">
							<div class="panel-body">
								<img src="{{URL::asset('images/blank-avatar.png')}}" alt="thumbnail" class="menu-thumbnail">
							</div>
							<div class="panel-footer">
								<span class="label label-warning menu-category">drink</span>
								<span class="menu-title">Lorem ipsum dolor sit</span>
								<span class="menu-price text-orange">Rp. 10.000</span>
							</div>
						</div>
					</div>
					@endfor
				</div>
			</div>
		</div>
	</div>
	<script src="{{URL::asset('plugins/jquery/jquery-3.1.1.min.js')}}"></script>
	<script src="{{URL::asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{URL::asset('plugins/theme/js/theme-cashier.js')}}"></script>
	<script src="{{URL::asset('plugins/theme/js/theme-helper.js')}}"></script>
</body>
</html>