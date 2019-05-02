@extends('layouts.theme')

@section('title', 'Edición de Planta')

@section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Planta : {{ $ID }} </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('plant.update', $PLANT->ID) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group col-md-12">
				<label for="name"> Nombre </label>
				<input type="text" class="form-control" id="name" name="name" value="{{ $PLANT->name }}">
			</div>
			<div class="form-group">
				<div class="col-md-8">
					<label for="tips"> Recomendaciones </label>
					<input type="text" class="form-control" id="tips" name="tips" value="{{ $PLANT->tips }}">
				</div>
				<div class="col-md-4">
					<label for="classification"> Clasificación </label>
					<select class="form-control select2" style="width:100%;" name="classification" id="classification" value="{{ $PLANT->classification }}">
						<option value="{{ $PLANT->classification }}" selected="disabled"> {{ $PLANT->getClassification($PLANT->classification) }} </option>
						@foreach($CLASSES as $CLASS)
							<option value="{{ $CLASS->ID }}"> {{ $CLASS->class }} </option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label for="stock"> Stock </label>
					<input class="form-control" type="text" name="stock" id="stock" value="{{ $PLANT->stock }}">
				</div>
				<div class="col-md-4">
					<label for="price"> Precio </label>
					<div class="input-group">
						<span class="input-group-addon"> $ </span>
						<input class="form-control" type="text" name="price" id="price" value="{{ $PLANT->price }}">
					</div>
				</div>
				<div class="col-md-4">
					<label for="image"> Imagen </label>
					<input class="form-control" type="text" name="image" id="image" value="{{ $PLANT->image }}">
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('plant.show', $ID) }}"> Cancelar </a>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection