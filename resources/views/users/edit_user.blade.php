@extends('layouts.theme')

@section('title', 'Edición de Usuario')

@section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Usuario : {{ $user->id }} </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('users.update', $user->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group col-md-12">
				<label for="name"> Nombre(s) & Apellidos </label>
				<input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
			</div>
			<div class="form-group col-md-12">
				<label for="email"> Correo </label>
				<input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
			</div>
			<div class="form-group col-md-12">
				<label for="phone"> Telefono </label>
				<input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
			</div> 
		</div> <!-- /. class="box-body" -->
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('users.show', $user->id) }}"> Cancelar </a>
		</div> <!-- /. class="box-footer" -->
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script> <!-- se usa para typear el telefóno -->
@endsection