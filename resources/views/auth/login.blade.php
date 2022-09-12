
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">

    <title>Librería de Viejo | Log in</title>

  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      
      <div class="login-logo">
        <a href="{{ route('home') }}"><span class="logo-lg"><b>Librería</b><i>De</i><b>Viejo</b></span></a>
      </div>

      <div class="login-box-body">
        @include('partials.errors')

        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group col-md-12">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus required placeholder="E-Mail">
                </div>

                <div class="form-group col-md-12">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                    <a class="btn btn-danger btn-block" href="{{ route('welcome') }}"> Cancelar </a>
                </div>
            </div>
        </form>
      </div> <!-- /. class="login-box-body" -->

    </div> <!-- /. class="login-box" -->

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

  </body> <!-- /. class="hold-transition login-page" -->
</html>