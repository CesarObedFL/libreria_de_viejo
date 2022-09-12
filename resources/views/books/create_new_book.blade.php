@extends('layouts.theme')

@section('title', 'Registro de Libros')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Libros </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.edit')
	@include('partials.errors')

	<form role="form" action="{{ route('books.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">

			<div class="form-group col-md-12">
				<label for="ISBN"> ISBN:  {{ ($ISBN) ? $ISBN : old('ISBN') . $TITLE }} </label>
				<input type="hidden" name="ISBN" id="ISBN" value="{{ ($ISBN) ? $ISBN : old('ISBN') }}">
			</div> <!-- /. class="form-group col-md-12" -->

			<div class="form-group">
				<div class="col-md-6">
					<label for="title"> Título </label>
					<input class="form-control" type="text" name="title" id="title" value="{{ ($TITLE) ? $TITLE : old('title') }}" required>
				</div>
				<div class="col-md-6">
					<label for="author"> Autor </label>
					<input class="form-control" type="text" name="author" id="author" value="{{ ($author) ? $author : old('author') }}" required>
				</div>
			</div> <!-- /. class="form-group" -->

			<div class="form-group">
				<div class="col-md-3">
					<label for="editorial"> Editorial </label>
					<input class="form-control" type="text" name="editorial" id="editorial" value="{{ ($editorial) ? $editorial : old('editorial') }}">
				</div> <!-- /. class="col-md-3" -->
				<div class="col-md-3">
					<label for="classification"> Clasificación </label>
	                <select class="form-control select2" style="width:100%;" name="classification_id" id="classification_id" value="{{ old('classification_id') }}">
	                  	<option value="{{ old('classification_id') }} selected="disabled"> </option>
	                  	@foreach($classes as $class)
	                  		<option value="{{ $class->id }}"> {{ $class->name }}</option>
						@endforeach
					</select>
            	</div> <!-- /. class="col-md-3" -->
            	<div class="col-md-3">
					<label for="genre"> Género *</label>
					<input class="form-control" type="text" name="genre" id="genre" value="{{ old('genre') }}">
				</div> <!-- /. class="col-md-3" -->
				<div class="col-md-3">
					<label for="collection"> Colección *</label>
					<input class="form-control" type="text" name="collection" id="collection" value="{{ old('collection') }}">
				</div> <!-- /. class="col-md-3" -->
			</div> <!-- /. class="form-group" -->

			<br>
			CARACTERÍSTICAS <hr class="col-xs-10 pull-right">

			<div class="form-group">
				<div class="col-md-4">
					<label for="edition"> Edición </label>
					<input class="form-control" type="text" name="edition" id="edition" value="{{ old('edition') }}">
				</div> <!-- /. class="col-md-4" -->
	        	<div class="col-md-4">
					<label for="stock"> Stock </label>
					<input class="form-control" type="number" min="1" name="stock" id="stock" value="{{ old('stock') }}">
				</div> <!-- /. class="col-md-4" -->
				<div class="col-md-4">
					<label for="price"> Precio </label>
					<div class="input-group">
						<span class="input-group-addon"> $ </span>
						<input class="form-control" type="text" name="price" id="price" value="{{ old('price') }}">
					</div>
				</div> <!-- /. class="col-md-4" -->
				<div class="col-md-4">
					<label for="conditions"> Condiciones </label>
					<input class="form-control" type="text" name="conditions" id="conditions" value="{{ old('conditions') }}">
				</div> <!-- /. class="col-md-4" -->
			</div> <!-- /. class="form-group" -->

			<div class="form-group">
				<div class="col-md-4">
					<label for="place"> Lugar </label>
					<select class="form-control select2" style="width:100%;" name="place" id="place">
	                  <option value="1" selected="selected"> Librería </option>
	                  <option value="2"> Almacén </option>
	                  <option value="3"> Exhibición </option>
	                  <option value="4"> Bazar </option>
	                </select>
				</div> <!-- /. class="col-md-4" -->
				<div class="col-md-4">
					<label for="language"> Idioma </label>
					<input class="form-control" type="text" name="language" id="language" value="{{ old('language') }}">
				</div> <!-- /. class="col-md-4" -->
			</div> <!-- /. class="form-group" -->

			<div class="form-group">
				<div class="col-md-4">
					<label for="location"> Estante </label>
					<select class="form-control select2" style="width:100%;" name="location" id="location">
						<option value="0" selected="selected"> Bodega </option>
						@for($i = 1; $i <= 13; $i++)
	                		<option value="{{ $i }}"> Estante {{ $i }} </option>
	                	@endfor
	                </select>
              	</div> <!-- /. class="col-md-4" -->
			</div> <!-- /. class="form-group" -->
			
		</div> {{-- /. box-body --}}

		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Registrar </button>
			<a class="btn btn-danger btn-block" href="{{ route('books.index') }}"> Cancelar </a>
		</div>

	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection