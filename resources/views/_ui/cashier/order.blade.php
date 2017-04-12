<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{URL::asset('plugins/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('plugins/fontawesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-order.css')}}">
	<link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-helper.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400" rel="stylesheet">
</head>
<body>
	<div class="container-fluid" id="wrapper">
		<div id="order-menu">
			<div class="container-fluid">
				
			</div>
		</div>
		<div id="order-detail">
			<div class="container-fluid">
				<div class="form-group">
					<input type="text" class="form-control input-lg" id="input-order-id" value="Order Number #00001" readonly>
				</div>
				<div class="form-group">
					<select name="" class="form-control input-lg">
						<option value="">choose table</option>
					</select>
				</div>
				<ul class="list-group" id="order-list">
					@for($i=1; $i < 6; $i++)
					<li class="list-group-item">
						<span class="order-count">x{{$i}}</span>
						<span class="order-name">Nasi Goreng</span>
						<span class="order-price">13.000</span>
						<button class="btn btn-danger btn-remove-cart"><i class="fa fa-trash"></i></button>
					</li>
					@endfor
				</ul>
			</div>
			<div class="footer">
				<button class="btn btn-black btn-block btn-lg">place order</button>
			</div>
		</div>
	</div>
</body>
<script src="{{URL::asset('plugins/jquery/jquery-3.1.1.min.js')}}"></script>
<script src="{{URL::asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('plugins/theme/js/theme-order.js')}}"></script>
<script src="{{URL::asset('plugins/theme/js/theme-helper.js')}}"></script>
</html>