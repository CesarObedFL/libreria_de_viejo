@extends('layouts.theme')

@section('title', 'Registro de Características')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Características : {{ $book_id }}</strong></div></h1><hr>
@endsection

@section('content')
	
	@include('partials.errors')

	<form role="form" action="{{ route('feature.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			{{-- <input name="_method" type="hidden" value="PATCH"> --}}
			<input type="hidden" id="book_id" name="book_id" value="{{ $book_id }}">
			<div class="form-group">
				<div class="col-md-4">
					<label for="edition"> Edición </label>
					<input type="text" class="form-control" id="edition" name="edition" 
					value="{{ old('edition') }}">
				</div>
				<div class="col-md-4">
					<label for="price"> Precio </label>
					<input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
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
			<a class="btn btn-danger btn-block" href="{{ url()->previous() }}"> Cancelar </a>
		</div>
	</form>
		

@endsection