@extends('layouts.theme')

@section('title', 'Edición de Libro')

@section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Libro : {{ $book->id }} </strong></div></h1><hr>
@endsection

@section('content')
	
	@include('partials.errors')

	<form role="form" action="{{ route('books.update', $book->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">

			<input name="_method" type="hidden" value="PATCH">

			<div class="form-group col-md-12">
				<label for="ISBN"> ISBN </label>
				<input type="text" class="form-control" id="ISBN" name="ISBN" 
				value="{{ $book->ISBN }}">
			</div>

			<div class="form-group col-md-12">
				<label for="title"> Título </label>
				<input type="text" class="form-control" id="title" name="title" 
				value="{{ $book->title }}">
			</div>

			<div class="form-group col-md-12">
				<label for="author"> Autor </label>
				<input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}">
			</div>

			<div class="form-group">
				<div class="col-md-6">
					<label for="editoral"> Editorial </label>
					<input type="text" class="form-control" id="editorial" name="editorial" value="{{ $book->editorial }}">
				</div>
				<div class="col-md-6">
					<label for="classification"> Clasificación </label>
	                <select class="form-control select2" style="width:100%;" name="classification_id" id="classification_id" value="{{ $book->classification->id }}">
	                  	<option value="{{ $book->classification->id }}"> {{ $book->classification->name }}</option>
	                  	@foreach($classes as $class)
	                  		<option value="{{ $class->id }}"> {{ $class->name }}</option>
						@endforeach
					</select>
            	</div>
			</div>

			<div class="form-group">
				<div class="col-md-6">
					<label for="genre"> Género </label>
					<input type="text" class="form-control" id="genre" name="genre" value="{{ $book->genre }}">
				</div>
				<div class="col-md-6">
					<label for="collection"> Colección </label>
					<input type="text" class="form-control" id="collection" name="collection" value="{{ $book->collection }}">
				</div>
			</div>

			{{-- BOOK FEATURES--}}
			<div class="form-group">
				<div class="col-md-4">
					<label for="edition"> Edición </label>
					<input type="text" class="form-control" id="edition" name="edition" 
					value="{{ $book->edition }}">
				</div>
				<div class="col-md-4">
					<label for="price"> Precio </label>
					<div class="input-group">
						<span class="input-group-addon"> $ </span>
						<input class="form-control" type="text" name="price" id="price" value="{{ $book->price }}">
					</div>
				</div>
				<div class="col-md-4">
					<label for="conditions"> Condiciones </label>
					<input type="text" class="form-control" id="conditions" name="conditions" value="{{ $book->conditions }}">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-4">
					<label for="stock"> Stock </label>
					<input type="text" class="form-control" id="stock" name="stock" value="{{ $book->stock }}">
				</div>
				<div class="col-md-4">
					<label for="place"> Lugar </label>
					<select class="form-control select2" style="width:100%;" name="place" id="place">
						<option value="{{ $book->place }}">{{ $book->place }}</option>
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
			{{-- /. BOOK FEATURES --}}

		</div> <!-- /. class="box-body" -->

		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('books.show', $book->id) }}"> Cancelar </a>
		</div>

	</form>
		

@endsection