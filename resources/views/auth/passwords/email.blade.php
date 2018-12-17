<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | Kulinerae.com</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-sign.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/theme/css/theme-helper.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row form-big" id="form-container">
        <div class="col-xs-12 col-sm-6 col-md-8 background-img image-fade" id="form-left" data-image="{{URL::asset('images/bg2.jpg')}}">
            <h2><a href="{{ url('/') }}" style="color: white">KULINERAE</a></h2>
            <p class="text-size-20">Your perfect place to manage and promote<br>your favorite Culinary</p>
            <div class="break-50"></div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4" id="form-right">
            <h3 class="form-title text-quintuple">Reset Password</h3>
            <form method="post" role="form" action="{{ url('/password/email') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="text-quadruple">Email</label>
                    <input name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
                    @endif
                </div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-group">
                    <button class="btn btn-primary btn-round" type="submit">Kirim Link Reset Password</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{URL::asset('plugins/theme/js/theme-helper.js')}}"></script>
</html>