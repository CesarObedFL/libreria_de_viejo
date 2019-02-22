@extends('layouts.theme')

@section('title', 'Registro de Libros')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Libros </strong></div></h1><hr>
@endsection

@section('content')

	<!-- <form action="#" method="get">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="Search...">
			<span class="input-group-btn">
				<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</form>	-->
	@include('partials.errors')

	<form role="form" action="{{ route('book.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="form-group col-md-12">
				<label for="ISBN"> ISBN </label>
				<input class="form-control" type="text" name="ISBN" id="ISBN" value="{{ old('ISBN') }}">
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="title"> Título </label>
					<input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
				</div>
				<div class="col-md-6">
					<label for="author"> Autor </label>
					<input class="form-control" type="text" name="author" id="author" value="{{ old('author') }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label for="editorial"> Editorial </label>
					<input class="form-control" type="text" name="editorial" id="editorial" value="{{ old('editorial') }}">
				</div>
				<div class="col-md-4">
					<label for="edition"> Edición </label>
					<input class="form-control" type="text" name="edition" id="edition" value="{{ old('edition') }}">
				</div>
				<div class="col-md-4">
					<label for="conditions"> Condiciones </label>
					<input class="form-control" type="text" name="conditions" id="conditions" value="{{ old('conditions') }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label for="classification"> Clasificación </label>
	                <select class="form-control select2" style="width:100%;" name="classification" id="classification" value="{{ old('classification') }}">
	                  	<option value="" selected="disabled"> </option>
	                  	@foreach($CLASSES as $CLASS)
	                  		<option value="{{ $CLASS->id }}"> {{ $CLASS->class }}</option>
						@endforeach
					</select>
            	</div>
            	<div class="col-md-4">
					<label for="stock"> Cantidad </label>
					<input class="form-control" type="text" name="stock" id="stock" value="{{ old('amount') }}">
				</div>
				<div class="col-md-4">
					<label for="price"> Precio </label>
					<div class="input-group">
						<span class="input-group-addon"> $ </span>
						<input class="form-control" type="text" name="price" id="price" value="{{ old('price') }}">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label for="genre"> Género </label>
					<input class="form-control" type="text" name="genre" id="genre" value="{{ old('genre') }}">
				</div>
				<div class="col-md-4">
					<label for="saga"> Saga </label>
					<input class="form-control" type="text" name="saga" id="saga" value="{{ old('saga') }}">
				</div>
				<div class="col-md-4">
					<label for="collection"> Colección </label>
					<input class="form-control" type="text" name="collection" id="collection" value="{{ old('collection') }}">
				</div>

			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label for="place"> Lugar </label>
					<select class="form-control select2" style="width:100%;" name="place" id="place">
	                  <option value="1" selected="selected"> Librería </option>
	                  <option value="2"> Almacén </option>
	                  <option value="3"> Exhibición </option>
	                  <option value="4"> Bazar </option>
	                </select>
				</div>
				<div class="col-md-4">
					<label for="language"> Idioma </label>
					<input class="form-control" type="text" name="language" id="language" value="{{ old('language') }}">
				</div>
				<input class="form-control" type="hidden" name="status" id="status" value="1">
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Registrar </button>
			<a class="btn btn-danger btn-block" href="{{ route('book.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection