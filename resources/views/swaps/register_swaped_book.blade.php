
@extends('layouts.theme')

@section('title', 'Registro Pendiente de Libro')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro Pendiente de Libro : {{ $SBOOK->id }} </strong></div></h1><hr>
@endsection

@section('content')
	
	@include('partials.errors')

	<form role="form" action="{{ route('swaps.update', $id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<input name="ISBN" type="hidden" value="{{ $SBOOK->ISBN }}">
			<input name="bookID" type="hidden" value="{{ $SBOOK->id }}">
			<div class="form-group col-md-12">
				<label for="ISBN"> ISBN: {{ $SBOOK->ISBN }} </label>
			</div>
			<div class="form-group col-md-12">
				<label for="title"> Título </label>
				<input type="text" class="form-control" id="title" name="title" 
				value="{{ $SBOOK->title }}">
			</div>
			<div class="form-group col-md-12">
				<label for="author"> Autor </label>
				<input type="text" class="form-control" id="author" name="author" value="{{ $SBOOK->author }}">
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="editoral"> Editorial </label>
					<input type="text" class="form-control" id="editorial" name="editorial" value="{{ $SBOOK->editorial }}">
				</div>
				<div class="col-md-6">
					<label for="classification"> Clasificación </label>
	                <select class="form-control select2" style="width:100%;" name="classification" id="classification" value="{{ $SBOOK->classification }}">
	                  	<option value="{{ $SBOOK->classification }}"> {{ $SBOOK->getClassification($SBOOK->classification) }}</option>
	                  	@foreach($CLASSES as $CLASS)
	                  		<option value="{{ $CLASS->id }}"> {{ $CLASS->class }}</option>
						@endforeach
					</select>
            	</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="genre"> Género </label>
					<input type="text" class="form-control" id="genre" name="genre" value="{{ $SBOOK->genre }}">
				</div>
				<div class="col-md-6">
					<label for="collection"> Colección </label>
					<input type="text" class="form-control" id="collection" name="collection" value="{{ $SBOOK->collection }}">
				</div>
			</div>
			{{-- BOOK FEATURES--}}
			<div class="form-group">
				<div class="col-md-4">
					<label for="edition"> Edición </label>
					<input type="text" class="form-control" id="edition" name="edition" 
					value="{{ $SBOOK->edition }}">
				</div>
				<div class="col-md-4">
					<label for="price"> Precio </label>
					<div class="input-group">
						<span class="input-group-addon"> $ </span>
						<input class="form-control" type="text" name="price" id="price" value="{{ $SBOOK->price }}">
					</div>
				</div>
				<div class="col-md-4">
					<label for="conditions"> Condiciones </label>
					<input type="text" class="form-control" id="conditions" name="conditions" value="{{ $SBOOK->conditions }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label for="stock"> Stock </label>
					<input type="text" class="form-control" id="stock" name="stock" value="{{ $SBOOK->stock }}">
				</div>
				<div class="col-md-4">
					<label for="place"> Lugar </label>
					<select class="form-control select2" style="width:100%;" name="place" id="place">
						<option value="{{ $SBOOK->place }}">{{ $SBOOK->place }}</option>
						<option value="1"> Librería </option>
						<option value="2"> Almacén </option>
						<option value="3"> Exhibición </option>
						<option value="4"> Bazar </option>
	                </select>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-4">
					<label for="location"> Estante </label>
					<select class="form-control select2" style="width:100%;" name="location" id="location">
						<option value="0" selected="selected"> Bodega </option>
						@for($i = 1; $i <= 13; $i++)
	                		<option value="{{ $i }}"> Estante {{ $i }} </option>
	                	@endfor
	                </select>
              	</div>
			</div>

			{{-- /BOOK FEATURES --}}

		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('swaps.show', $id) }}"> Cancelar </a>
		</div>
	</form>
		

@endsection
