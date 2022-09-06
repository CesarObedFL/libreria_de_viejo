@extends('layouts.theme')

@section('title', 'Edición de Libro')

@section('content-header')
	<h1><div class="col-md-8"><strong> {{ $feature->book->id }} : {{ $feature->book->title }}</strong></div></h1><hr>
@endsection

@section('content')
	
	@include('partials.errors')
	
	<h3>Edición de Características</h3>
	<form role="form" action="{{ route('features.update', $feature->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group">
				<div class="col-md-4">
					<label for="edition"> Edición </label>
					<input type="text" class="form-control" id="edition" name="edition" value="{{ $feature->edition }}">
				</div>
				<div class="col-md-4">
					<label for="price"> Precio </label>
					<div class="input-group">
						<span class="input-group-addon"> $ </span>
						<input class="form-control" type="text" name="price" id="price" value="{{ $feature->price }}">
					</div>
				</div>
				<div class="col-md-4">
					<label for="conditions"> Condiciones </label>
					<input type="text" class="form-control" id="conditions" name="conditions" value="{{ $feature->conditions }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<label for="stock"> Stock </label>
					<input type="text" class="form-control" id="stock" name="stock" value="{{ $feature->stock }}">
				</div>
				<div class="col-md-3">
					<label for="place"> Lugar </label>
					<select class="form-control select2" style="width:100%;" name="place" id="place">
						<option value="{{ $feature->place }}">{{ $feature->place }}</option>
						<option value="1"> Librería </option>
						<option value="2"> Almacén </option>
						<option value="3"> Exhibición </option>
						<option value="4"> Bazar </option>
	                </select>
				</div>
				<div class="col-md-3">
					<label for="status"> Estatus </label>
					<select class="form-control select2" style="width:100%;" name="status" id="status" value="{{ $feature->status }}">
	                  	<option value="{{ $feature->status }}"> {{ $feature->status }}</option>
	                  	<option value="1"> Disponible </option>
	                  	<option value="2"> Prestado </option>
					</select>
				</div>
				<div class="col-md-3">
					<label for="language"> Lenguaje </label>
					<input type="text" class="form-control" id="language" name="language" value="{{ $feature->language }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-1">
					<label>Estante:</label>
				</div>
				<div class="col-md-10">
					@for($i = 1; $i <= 13; $i++)
	                	<label>{{'['.$i.' '}}<input type="radio" name="location" id="location" value="{{ $i }}">{{']'}}</label>
	                @endfor
	                <label>[Bodega <input type="radio" name="location" id="location" value="0" checked>]</label>
              	</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('features.show', $feature->id) }}"> Cancelar </a>
		</div>
	</form>
		

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection