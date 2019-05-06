@extends('layouts.theme')

@section('title', 'Edición de Libro')

@section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Libro : {{ $BOOK->id }} </strong></div></h1><hr>
@endsection

@section('content')
	
	@include('partials.errors')

	<form role="form" action="{{ route('book.update', $BOOK->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group col-md-12">
				<label for="title"> Título </label>
				<input type="text" class="form-control" id="title" name="title" 
				value="{{ $BOOK->title }}">
			</div>
			<div class="form-group col-md-12">
				<label for="author"> Autor </label>
				<input type="text" class="form-control" id="author" name="author" value="{{ $BOOK->author }}">
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="editoral"> Editorial </label>
					<input type="text" class="form-control" id="editorial" name="editorial" value="{{ $BOOK->editorial }}">
				</div>
				<div class="col-md-6">
					<label for="classification"> Clasificación </label>
	                <select class="form-control select2" style="width:100%;" name="classification" id="classification" value="{{ $BOOK->classification }}">
	                  	<option value="{{ $BOOK->classification }}"> {{ $BOOK->getClassification($BOOK->classification) }}</option>
	                  	@foreach($CLASSES as $CLASS)
	                  		<option value="{{ $CLASS->id }}"> {{ $CLASS->class }}</option>
						@endforeach
					</select>
            	</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="genre"> Género </label>
					<input type="text" class="form-control" id="genre" name="genre" value="{{ $BOOK->genre }}">
				</div>
				<div class="col-md-6">
					<label for="collection"> Colección </label>
					<input type="text" class="form-control" id="collection" name="collection" value="{{ $BOOK->collection }}">
				</div>
			</div>
			{{-- BOOK FEATURES--}}
			<div class="form-group">
				<div class="col-md-4">
					<label for="edition"> Edición </label>
					<input type="text" class="form-control" id="edition" name="edition" 
					value="{{ $BOOK->edition }}">
				</div>
				<div class="col-md-4">
					<label for="price"> Precio </label>
					<div class="input-group">
						<span class="input-group-addon"> $ </span>
						<input class="form-control" type="text" name="price" id="price" value="{{ $BOOK->price }}">
					</div>
				</div>
				<div class="col-md-4">
					<label for="conditions"> Condiciones </label>
					<input type="text" class="form-control" id="conditions" name="conditions" value="{{ $BOOK->conditions }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<label for="stock"> Stock </label>
					<input type="text" class="form-control" id="stock" name="stock" value="{{ $BOOK->stock }}">
				</div>
				<div class="col-md-3">
					<label for="place"> Lugar </label>
					<select class="form-control select2" style="width:100%;" name="place" id="place">
						<option value="{{ $BOOK->place }}">{{ $BOOK->place }}</option>
						<option value="1"> Librería </option>
						<option value="2"> Almacén </option>
						<option value="3"> Exhibición </option>
						<option value="4"> Bazar </option>
	                </select>
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
	                <label>[Bodega <input type="radio" name="location" id="location" value="0">]</label>
              	</div>
			</div>
			{{-- /BOOK FEATURES --}}

		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('book.show', $BOOK->id) }}"> Cancelar </a>
		</div>
	</form>
		

@endsection