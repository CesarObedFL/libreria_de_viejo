@extends('layouts.theme')

@section('title', 'Registro de Características')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Características : {{ $bookID }}</strong></div></h1><hr>
@endsection

@section('content')
	
	@include('partials.errors')

	<form role="form" action="{{ route('feature.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input type="hidden" id="bookID" name="bookID" value="{{ $bookID }}">
			<div class="form-group">
				<div class="col-md-4">
					<label for="edition"> Edición </label>
					<input type="text" class="form-control" id="edition" name="edition" 
					value="{{ old('edition') }}">
				</div>
				<div class="col-md-4">
					<label for="price"> Precio </label>
					<div class="input-group">
						<span class="input-group-addon"> $ </span>
						<input class="form-control" type="text" name="price" id="price" value="{{ old('price') }}">
					</div>
				</div>
				<div class="col-md-4">
					<label for="conditions"> Condiciones </label>
					<input type="text" class="form-control" id="conditions" name="conditions" value="{{ old('conditions') }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<label for="stock"> Stock </label>
					<input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
				</div>
				<div class="col-md-3">
					<label for="place"> Lugar </label>
					<select class="form-control select2" style="width:100%;" name="place" id="place">
						<option value="{{ old('place') }}">{{ old('place') }}</option>
						<option value="1"> Librería </option>
						<option value="2"> Almacén </option>
						<option value="3"> Exhibición </option>
						<option value="4"> Bazar </option>
	                </select>
				</div>
				<div class="col-md-3">
					<label for="status"> Estatus </label>
					<select class="form-control select2" style="width:100%;" name="status" id="status" value="{{ old('status') }}">
	                  	<option value="{{ old('status') }}"> {{ old('status') }}</option>
	                  	<option value="1"> Disponible </option>
	                  	<option value="2"> Prestado </option>
					</select>
				</div>
				<div class="col-md-3">
					<label for="language"> Lenguaje </label>
					<input type="text" class="form-control" id="language" name="language" value="{{ old('language') }}">
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('book.show', $bookID) }}"> Cancelar </a>
		</div>
	</form>
		
@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection