<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Kulinerae.com</title>
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
            <a href="{{ url('/register') }}" class="btn btn-primary btn-round">Daftar Sekarang!</a>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4" id="form-right">
            <h3 class="form-title text-quintuple">MEMBER LOGIN</h3>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="post" role="form" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="text-quadruple">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="text-quadruple">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                    <label for="password" class="text-quadruple">Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Reset Password
                    </button>
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