<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Librería de Viejo | @yield('title')</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

  @yield('styles')

</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <header class="main-header">
    <a href="{{ route('home') }}" class="logo">
      <span class="logo-mini"><b><b>L</b><i>D</i><b>V</b></span>
      <span class="logo-lg"><b>Librería</b><i>De</i><b>Viejo</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          @if(Auth::check())
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">{{ Auth::user()->getUserRoleAttribute() }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center"><a href="#">Perfil</a></div>
                    <div class="col-xs-4 text-center"><a href="#">Ventas</a></div>
                    <div class="col-xs-4 text-center">
                      <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Salir <i class="fa fa-sign-out"></i>
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                      </form>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        @else
          <li><a href="{{ route('login') }}">Entrar <i class="fa fa-sign-in"></i></a></li>
        @endif
      </div>
    </nav>
  </header>


  <!-- Left side column. contains the logo and sidebar -->
  @if(Auth::check())
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- search form - ->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><i class="fa fa-chevron-right"></i> OPERACIONES</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span> Ventas </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('sale.create') }}"><i class="fa fa-circle-o"></i> Libros</a></li>
            <!-- <li><a href=""><i class="fa fa-circle-o"></i> Plantas</a></li> -->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-refresh"></i>
            <span> Trueques </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('bartering.create') }}"><i class="fa fa-circle-o"></i> Realizar</a></li>
            <li><a href="{{ route('bartering.index') }}"><i class="fa fa-circle-o"></i> Mostrar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gift"></i>
            <span> Donaciones </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route(/*'donation.create'*/'home') }}"><i class="fa fa-circle-o"></i> Realizar</a></li>
            <li><a href="{{ route(/*'donation.index'*/'home') }}"><i class="fa fa-circle-o"></i> Mostrar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-mail-forward"></i>
            <span> Préstamos </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route(/*'loan.create'*/'home') }}"><i class="fa fa-circle-o"></i> Realizar</a></li>
            <li><a href="{{ route(/*'loan.index'*/'home') }}"><i class="fa fa-circle-o"></i> Mostrar</a></li>
          </ul>
        </li>
        <!-- <li><a href="{ route('home') }}"><i class="fa fa-mail-reply"></i><span> Devoluciones</span></a></li>
        <li><a href="{ route('home') }}"><i class="fa fa-calculator"></i><span> Corte de Caja</span></a></li>-->
      </ul>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><i class="fa fa-chevron-right"></i> REGISTROS </li>
        <li>
          <a href="{{ route('book.index') }}"><i class="fa fa-book"></i><span> Libros </span></a>
        </li>
        <li>
          <!-- <a href="{ { route(/*'plant.index'*/'home') }}"><i class="fa fa-pagelines"></i><span> Plantas </span></a> -->
        </li>
        <li>
          <a href="{{ route('user.index') }}"><i class="fa fa-users"></i><span> Usuarios </span></a>
        </li>
        <li>
          <a href="{{ route('client.index') }}"><i class="fa fa-user-plus"></i><span> Clientes </span></a>
        </li>
        <li>
          <a href="{{ route('classification.index') }}"><i class="fa fa-tags"></i><span> Clasificaciones</span></a>
        </li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><i class="fa fa-chevron-right"></i> DOCUMENTACIÓN </li>
        <!-- <li><a href="#"><i class="fa fa-search"></i><span> Busquedas </span></a></li> -->
        <li><a href="https://adminlte.io/docs"><i class="fa fa-info"></i> <span>Documentación </span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  @endif

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container"
        @if(session()->has('flash'))
          <div class="alert alert-info">{{ session('flash') }} </div>
        @endif
      </div>
      @yield('content-header')
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row"> <!-- DIV para el carrusel de imagenes (home.blade.php) -->
        <div class="col-md-10">
          @yield('H')  <!-- home.blade.php : carrucel -->
        </div>
      </div>

      <!-- Main row -->
      <div class="row">

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
            </div>
            <div class="box-body pad table-responsive">

              @yield('content')                           <!--  /.CONTENT  -->

            </div>
            <!-- /.box -->
          </div>
        </div>

        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
        </section>
        <!-- /.Left col -->

        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
         <h3 class="control-sidebar-heading">Home Settings</h3>
      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <!-- <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div> -->
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong> Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>. </strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{ { asset('dist/js/pages/dashboard.js') }}"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="{ { asset('dist/js/demo.js') }}"></script> -->

@section('js')
@show
@yield('scripts')

</body>
</html>
