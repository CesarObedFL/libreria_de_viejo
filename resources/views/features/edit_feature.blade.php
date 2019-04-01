@extends('layouts.theme')

@section('title', 'Edición de Libro')

@section('content-header')
	<h1><div class="col-md-8"><strong> {{ $BOOK->id }} : {{ $BOOK->title }}</strong></div></h1><hr>
@endsection

@section('content')
	
	@include('partials.errors')
	<h3>Edición de Características</h3>
	<form role="form" action="{{ route('feature.update', $FEATURE->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group">
				<div class="col-md-4">
					<label for="edition"> Edición </label>
					<input type="text" class="form-control" id="edition" name="edition" 
					value="{{ $FEATURE->edition }}">
				</div>
				<div class="col-md-4">
					<label for="price"> Precio </label>
					<input type="text" class="form-control" id="price" name="price" value="{{ $FEATURE->price }}">
				</div>
				<div class="col-md-4">
					<label for="conditions"> Condiciones </label>
					<input type="text" class="form-control" id="conditions" name="conditions" value="{{ $FEATURE->conditions }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<label for="stock"> Stock </label>
					<input type="text" class="form-control" id="stock" name="stock" value="{{ $FEATURE->stock }}">
				</div>
				<div class="col-md-3">
					<label for="place"> Lugar </label>
					<select class="form-control select2" style="width:100%;" name="place" id="place">
						<option value="{{ $FEATURE->place }}">{{ $FEATURE->place }}</option>
						<option value="1"> Librería </option>
						<option value="2"> Almacén </option>
						<option value="3"> Exhibición </option>
						<option value="4"> Bazar </option>
	                </select>
				</div>
				<div class="col-md-3">
					<label for="status"> Estatus </label>
					<select class="form-control select2" style="width:100%;" name="status" id="status" value="{{ $FEATURE->status }}">
	                  	<option value="{{ $FEATURE->status }}"> {{ $FEATURE->status }}</option>
	                  	<option value="1"> Disponible </option>
	                  	<option value="2"> Prestado </option>
					</select>
				</div>
				<div class="col-md-3">
					<label for="language"> Lenguaje </label>
					<input type="text" class="form-control" id="language" name="language" value="{{ $FEATURE->language }}">
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('feature.show', $FEATURE->id) }}"> Cancelar </a>
		</div>
	</form>
		

@endsection