@extends('layouts.theme')

@section('title', 'Registro de Clientes')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Clientes </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors') 

	<form role="form" action="{{ route('clients.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="form-group col-md-12">
				<label for="name"> Nombre </label>
				<input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label for="email"> E-Mail </label>
					<input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
				</div>
				<div class="col-md-4">
					<label for="phone"> Teléfono </label>
					<input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone') }}">
				</div>
				<div class="col-md-4">
					<label for="type"> Tipo </label>
					<select class="form-control select2" style="width:100%;" name="type" id="type">
	                  <option value="1" selected="selected"> Interno </option>
	                  <option value="2"> Externo </option>
	                </select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					<label for="interests"> Intereses </label>
					<input class="form-control" type="text" name="interests" id="interests" value="{{ old('interests') }}">
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Registrar </button>
			<a class="btn btn-danger btn-block" href="{{ route('clients.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}">
@endsection