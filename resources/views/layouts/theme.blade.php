<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Librería de Viejo | @yield('title')</title>

  <meta content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
  <!-- <link rel="stylesheet" href="{ { asset('bower_components/morris.js/morris.css') }}"> -->
  <!-- <link rel="stylesheet" href="{ { asset('bower_components/jvectormap/jquery-jvectormap.css') }}"> -->
  <!-- <link rel="stylesheet" href="{ { asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> -->
  <!-- <link rel="stylesheet" href="{ { asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}"> -->
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
            <li class="user user-menu">
              <a href="{{ route('sale.create') }}"><i class="fa fa-money"></i> Realizar Venta</a>
            </li>

            @if(Auth::user()->isAdmin())        <!--  Admin functions   -->
            <li class="user user-menu">
              <a href="{{ route('admin.cut') }}"><i class="fa fa-calculator"></i><span> Corte de Caja</span></a>
            </l>
            <li class="user user-menu">
              <a href="{{ route('home') }}"><i class="fa fa-barcode"></i><span> Códigos de Barras</span></a>
            </li>
            <li>
              <a href="{{ route('user.index') }}"><i class="fa fa-user-plus"></i><span> Usuarios</span></a>
            </li>
            @endif

            <!----------------------------- USER MENU ------------------------------>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  {{ Auth::user()->getUserRoleAttribute() }}
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>
              </a>
              <ul class="dropdown-menu" style="border-color: black">
                <li class="user-body">
                  <div class="row">
                    <div class="text-center"><a href="{{ route('user.perfil') }}">
                      <i class="fa fa-user"></i> Perfil</a></div>
                  </div>
                </li>
                <li class="user-body">
                  <div class="row">
                    <div class="text-center"><a href="{{ route('sale.index') }}">{{ (Auth::user()->isAdmin()) ? '': 'Mis' }} <i class="fa fa-archive"></i> Ventas</a></div>
                  </div>
                </li>
                <li class="user-body">
                  <div class="row">
                    <div class="text-center">
                      <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Salir
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                      </form>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <!----------------------------- USER MENU ------------------------------>

            <!-- <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li> -->
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

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><i class="fa fa-chevron-right"></i> OPERACIONES</li>
        <!--
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span> Ventas </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{ { route('BookSale') }}"><i class="fa fa-circle-o"></i> Libros</a></li>
            <li><a href="{ { route('PlantSale') }}"><i class="fa fa-circle-o"></i> Plantas</a></li>
          </ul>
        </li> 
        -->
        <li><a href="{{ route('bartering.index') }}"><i class="fa fa-refresh"></i><span>Trueques</span></a></li>
        <li><a href="{{ route('donation.index') }}"><i class="fa fa-gift"></i><span>Donaciones</span></a></li>
        <li><a href="{{ route('loan.index') }}"><i class="fa fa-mail-forward"></i><span>Préstamos</span></a></li>
        <li><a href="{{ route('loan.clients') }}"><i class="fa fa-mail-reply"></i><span>Devoluciones</span></a></li>
      </ul>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><i class="fa fa-chevron-right"></i> REGISTROS </li>
        <li><a href="{{ route('book.index') }}"><i class="fa fa-book"></i><span> Libros </span></a></li>
        <li><a href="{{ route('plant.index') }}"><i class="fa fa-pagelines"></i><span> Plantas </span></a></li>
        <li><a href="{{ route('client.index') }}"><i class="fa fa-users"></i><span> Clientes </span></a>
        </li>
        <li><a href="{{ route('classification.index') }}"><i class="fa fa-tags"></i><span> Clasificaciones</span></a></li>
      </ul>
      {{--
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><i class="fa fa-chevron-right"></i> DOCUMENTACIÓN </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-info"></i> <span>Documentación </span></a></li>
      </ul>
      --}}
    </section>
    <!-- /.sidebar -->
  </aside>
  @endif

  
  <div class="content-wrapper"> <!-- Content Wrapper. Contains page content -->

    <section class="content-header"> <!-- Content Header (Page header) -->
      @yield('content-header')
    </section>
    <section class="content"> <!-- Main content -->
      <div class="row"> <!-- DIV para el carrusel de imagenes (home.blade.php) -->
        <div class="col-md-10">
          @yield('H')  <!-- home.blade.php : carrucel -->
        </div>
      </div>

      <div class="row"> <!-- Main row -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header"> </div>
            <div class="box-body pad table-responsive">
              @yield('content')                           <!--  /.CONTENT  -->
            </div>
          </div>
        </div>
        <!--
        <section class="col-lg-7 connectedSortable"> </section> < !-- Left col - ->
        <section class="col-lg-5 connectedSortable"> </section> < !-- right col (We are only adding the ID to make the widgets sortable) - ->
        -->
      </div>  <!-- /.row (main row) -->
    </section>   <!-- /.main content -->
  </div>
  <!-- /.content-wrapper -->
  <!--
  <!-- Control Sidebar -->                                    <!--      SETTINGS        - ->
  <aside class="control-sidebar control-sidebar-dark">
    < !-- Create the tabs - ->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    
    <div class="tab-content"> < !-- Tab panes - ->
      
      <div class="tab-pane" id="control-sidebar-home-tab"> < !-- Home tab content - ->
         <h3 class="control-sidebar-heading">Home Settings</h3>
      </div>
      < !-- /.tab-pane - ->
      < !-- Stats tab content - ->
      < !-- <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div> - ->
      < !-- /.tab-pane - ->
      < !-- Settings tab content - ->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>
        </form>
      </div>
      < !-- /.tab-pane - ->
    </div>
  </aside>
  < !-- /.control-sidebar - ->
  < !-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar - ->
  < !-- <div class="control-sidebar-bg"></div> - ->
  -->

  <footer>
    <div align="center">
      <p class="text-muted">CASACEM - Av Chapultepec Sur 376, Obrera, 44140, Guadalajara, Jalisco, Mexico. - Tel: 01 33 3615 4499</p>
      <a href="https://www.facebook.com/casacemgdl/" target="_black"><img src="{{ asset('dist/img/facebook.png') }}" width="30" height="30" align="center"></img></a>
      <!--<a href="https://www.instagram.com" target="_black"><img src="./Recursos/imagenes/instagram.jpg" width="30" height="30" align="right"></img></a></td>-->
    </div>
  </footer>
  <br>

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
<!-- <script src="{ { asset('bower_components/raphael/raphael.min.js') }}"></script> -->
<!-- <script src="{ { asset('bower_components/morris.js/morris.min.js') }}"></script> -->
<!-- Sparkline -->
<!-- <script src="{ { asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script> -->
<!-- jvectormap -->
<!-- <script src="{ { asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{ { asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="{ { asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script> -->
<!-- daterangepicker -->
<!-- <script src="{ { asset('bower_components/moment/min/moment.min.js') }}"></script> -->
<!-- <script src="{ { asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script> -->
<!-- datepicker -->
<!-- <script src="{ { asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

@yield('scripts') {{-- PARA CARGAR LOS SCRIPS PROPIOS DE CADA VISTA --}}

</body>
</html>
