@extends('layouts.theme')

@section('title', 'Edición de Usuario')

@section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Usuario : {{ $ID }} </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('user.update', $USER->ID) }}" method="POST">
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
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('user.perfil') }}"> Cancelar </a>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection