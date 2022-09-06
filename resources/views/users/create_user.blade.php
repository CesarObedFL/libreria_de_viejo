@extends('layouts.theme')

@section('title', 'Registro de Usuarios')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Usuario </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('users.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="form-group col-md-12">
				<label for="name"> Nombre(s) & Apellidos </label>
				<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
			</div>
			<div class="form-group col-md-12">
				<label for="email"> Correo </label>
				<input type="email" class="form-control" id="email" name="email"  value="{{ old('email') }}">
			</div>
			<div class="form-group col-md-12"> 
				<label for="phone"> Telefono </label>
				<input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
			</div>
			<div class="form-group col-md-12">
				<label for="password"> Password </label>
				<input type="password" class="form-control" id="password" name="password">
			</div>
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
			<button type="submit" class="btn btn-primary btn-block"> Registrar </button>
			<a class="btn btn-danger btn-block" href="{{ route('users.index') }}"> Cancel </a>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection
