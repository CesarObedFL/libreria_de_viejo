<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Librería de Viejo | Bienvenido!</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
</head>
<body class="hold-transition skin-blue">

<div class="wrapper">
  <header class="main-header">
    <a href="{{ route('home') }}" class="logo">
      <span class="logo-lg"><b>Librería</b><i>De</i><b>Viejo</b></span>
    </a>
    <nav class="navbar">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li><a href="{{ route('loginform') }}">Entrar <i class="fa fa-sign-in"></i></a></li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
      </div>
      <div class="box-body pad table-responsive">
        <section class="content">
          <div class="col-md-12">
            <div class="row justify-content-center">
              <div class="box-body">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
                  </ol>
                  <div class="carousel-inner">
                      <div class="item active">
                          <img src="{{ asset('dist/img/slides/c.jpg') }}" alt="First slide" width="100%" height="100%">
                      </div>
                      <div class="item">
                          <img src="{{ asset('dist/img/slides/a.jpg') }}" alt="Second slide" width="100%" height="100%">
                      </div>
                      <div class="item">
                          <img src="{{ asset('dist/img/slides/s.jpg') }}" alt="Third slide" width="100%" height="100%">
                      </div>
                      <div class="item">
                          <img src="{{ asset('dist/img/slides/e.jpg') }}" alt="Third slide" width="100%" height="100%">
                      </div>
                  </div>
                  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>

<footer>
  <div align="center">
    <p class="text-muted">CASACEM - Av Chapultepec Sur 376, Obrera, 44140, Guadalajara, Jalisco, Mexico. - Tel: 01 33 3615 4499</p>
    <a href="https://www.facebook.com/casacemgdl/" target="_black"><img src="{{ asset('dist/img/facebook.png') }}" width="30" height="30" align="center"></img></a>
    <!--<a href="https://www.instagram.com" target="_black"><img src="./Recursos/imagenes/instagram.jpg" width="30" height="30" align="right"></img></a></td>-->
  </div>
  <hr>
</footer>

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

@section('js')
@show

</body>
</html>