<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{ { asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{ { asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{ { asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{ { asset('dist/css/AdminLTE.min.css') }}">

    <title>Librería de Viejo | Log in</title>

  </head> -->

@extends('layouts.theme')

@section('title', 'Edición de Usuario')

@section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Usuario : {{ $id }} </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('user.update', $USER->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group col-md-12">
				<label for="name"> Nombre(s) & Apellidos </label>
				<input type="text" class="form-control" id="name" name="name" value="{{ $USER->name }}">
			</div>
			<div class="form-group col-md-12">
				<label for="email"> Correo </label>
				<input type="email" class="form-control" id="email" name="email" value="{{ $USER->email }}">
			</div>
			<div class="form-group col-md-12">
				<label for="phone"> Telefono </label>
				<input type="text" class="form-control" id="phone" name="phone" value="{{ $USER->phone }}">
			</div>
			<!-- <div class="form-group col-md-12">
				<label for="password"> Password </label>
				<input type="password" class="form-control" id="password" name="password">
			</div> -->
			<div class="form-group col-md-12">
				<p> Qué privilegios tendrá el usuario? &nbsp&nbsp&nbsp
					<input type="radio" name="role" value="3" class="flat-red">
					<label for="role"> Vendedor &nbsp&nbsp</label>
					<input type="radio" name="role" value="2" class="flat-red">
					<label for="role"> Supervisor &nbsp&nbsp</label>
					<input type="radio" name="role" value="1" class="flat-red">
					<label for="role"> Administrador </label>
				</p>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('user.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection

  <!-- <script src="{ { asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
  <script src="{ { asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</html> -->