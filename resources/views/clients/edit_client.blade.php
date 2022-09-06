@extends('layouts.theme')

@section('title', 'Edición de Clientes')

@section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Clientes : {{ $client->id }} </strong></div></h1><hr>
@endsection

@section('content')
	
	@include('partials.errors') 

	<form role="form" action="{{ route('clients.update', $client->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group col-md-12">
				<label for="name"> Nombre </label>
				<input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}">
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label for="email"> E-Mail </label>
					<input type="text" class="form-control" id="email" name="email" value="{{ $client->email }}">
				</div>
				<div class="col-md-4">
					<label for="phone"> Teléfono </label>
					<input type="text" class="form-control" id="phone" name="phone" value="{{ $client->phone }}">
				</div>
				<div class="col-md-4">
					<label for="type"> Tipo </label>
					<select class="form-control select2" style="width:100%;" id="type" name="type">
						<option value="{{ $client->type }}" selected="disabled"> {{ $client->type }} </option>
						<option value="1"> Interno </option>
						<option value="2"> Externo </option>
					</select>	
				</div>
				<div class="form-group col-md-12">
					<label for="interests"> Intereses </label>
					<input type="text" class="form-control" id="interests" name="interests" value="{{ $client->interests }}">
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('clients.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection