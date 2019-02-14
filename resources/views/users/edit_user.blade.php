<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset(bower_components/bootstrap/dist/css/bootstrap.min.css) }}">
    <link rel="stylesheet" href="{{ asset(bower_components/font-awesome/css/font-awesome.min.css)}}">
    <link rel="stylesheet" href="{{ asset(bower_components/Ionicons/css/ionicons.min.css) }}">
    <link rel="stylesheet" href="{{ asset(dist/css/AdminLTE.min.css) }}">

    <title>Librería de Viejo | Log in</title>

  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="{{ route('home') }}"><span class="logo-lg"><b>Librería</b><i>De</i><b>Viejo</b></span></a>
      </div>

      <div class="login-box-body">
        @include('partials.errors')

        <input name="_method" type="hidden" value="PATCH">
      </div>

    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>

<!-- 
@ extends('layouts.theme')

@ section('title', 'Edición de Usuario')

@ section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Usuario : { { $id }}</strong></div></h1><hr>
@ endsection

@ section('content')

	@ include('partials.errors')

	<form role="form" action="{ { route('user.store') }}" method="PATCH">
		{ { csrf_field() }}
		<div class="box-body">
			<!-- <input name="_method" type="hidden" value="PATCH"> ->
			<div class="form-group col-md-12">
				<label for="nombre"> Nombre(s) & Apellidos </label>
				<input type="text" class="form-control" id="nombre" name="nombre" value="{ { $USER->name }}">
			</div>
			<div class="form-group col-md-12">
				<label for="email"> Correo </label>
				<input type="email" class="form-control" id="email" name="email" value="{ { $USER->email }}">
			</div>
			<div class="form-group col-md-12">
				<label for="telefono"> Telefono </label>
				<input type="text" class="form-control" id="telefono" name="telefono" value="{ { $USER->phone }}">
			</div>
			<!-- <div class="form-group col-md-12">
				<label for="password"> Password </label>
				<input type="password" class="form-control" id="password" name="password">
			</div> ->
			<div class="form-group col-md-12">
				<p> Qué privilegios tendrá el usuario? &nbsp&nbsp&nbsp
					<input type="radio" name="rol" value="3" class="flat-red">
					<label for="rol"> Vendedor &nbsp&nbsp</label>
					<input type="radio" name="rol" value="2" class="flat-red">
					<label for="rol"> Supervisor &nbsp&nbsp</label>
					<input type="radio" name="rol" value="1" class="flat-red">
					<label for="rol"> Administrador </label>
				</p>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{ { route('user.index') }}"> Cancel </a>
		</div>
	</form>

@ endsection
-->