@extends('layouts.theme')

@section('title', 'Edición de Libro')

@section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Libro : {{ $BOOK->ID }} </strong></div></h1><hr>
@endsection

@section('content')
	
	@include('partials.errors')

	<form role="form" action="{{ route('book.update', $BOOK->ID) }}" method="POST">
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
				<div class="col-md-4">
					<label for="editoral"> Editorial </label>
					<input type="text" class="form-control" id="editorial" name="editorial" value="{{ $BOOK->editorial }}">
				</div>
				<div class="col-md-4">
					<label for="genre"> Género </label>
					<input type="text" class="form-control" id="genre" name="genre" value="{{ $BOOK->genre }}">
				</div>
				<div class="col-md-4">
					<label for="classification"> Clasificación </label>
	                <select class="form-control select2" style="width:100%;" name="classification" id="classification" value="{{ $BOOK->classification }}">
	                  	<option selected="disabled"> </option>
	                  	@foreach($CLASSES as $CLASS)
	                  		<option value="{{ $CLASS->id }}"> {{ $CLASS->class }}</option>
						@endforeach
					</select>
            	</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label for="stock"> Stock </label>
					<input type="text" class="form-control" id="stock" name="stock" value="{{ $BOOK->stock }}">
				</div>
				<div class="col-md-4">
					<label for="saga"> Saga </label>
					<input type="text" class="form-control" id="saga" name="saga" value="{{ $BOOK->saga }}">
				</div>
				<div class="col-md-4">
					<label for="collection"> Colección </label>
					<input type="text" class="form-control" id="collection" name="collection" value="{{ $BOOK->collection }}">
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('book.show', $BOOK->ID) }}"> Cancelar </a>
		</div>
	</form>
		

@endsection