@extends('layouts.theme')

@section('title', 'Edición de Planta')

@section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Planta : {{ $plant->id }} </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('plants.update', $plant->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">

			<input name="_method" type="hidden" value="PATCH">

			<div class="form-group col-md-12">
				<label for="name"> Nombre </label>
				<input type="text" class="form-control" id="name" name="name" value="{{ $plant->name }}">
			</div> <!-- /. class="form-group col-md-12" -->

			<div class="form-group">
				<div class="col-md-8">
					<label for="tips"> Recomendaciones </label>
					<input type="text" class="form-control" id="tips" name="tips" value="{{ $plant->tips }}">
				</div>
				<div class="col-md-4">
					<label for="classification"> Clasificación </label>
					<select class="form-control select2" style="width:100%;" name="classification_id" id="classification_id" value="{{ $plant->classification->id }}">
						<option value="{{ $plant->classification->id }}" selected="disabled"> {{ $plant->classification->name }} </option>
						@foreach($classes as $class)
							<option value="{{ $class->id }}"> {{ $class->name }} </option>
						@endforeach
					</select>
				</div> 
			</div> <!-- /. class="form-group" -->

			<div class="form-group">
				<div class="col-md-4">
					<label for="stock"> Stock </label>
					<input class="form-control" type="text" name="stock" id="stock" value="{{ $plant->stock }}">
				</div>
				<div class="col-md-4">
					<label for="price"> Precio </label>
					<div class="input-group">
						<span class="input-group-addon"> $ </span>
						<input class="form-control" type="text" name="price" id="price" value="{{ $plant->price }}">
					</div>
				</div>
				{{--
				<div class="col-md-4">
					<label for="image"> Imagen </label>
					<input class="form-control" type="text" name="image" id="image" value="{{ $plant->image }}">
				</div>
				--}}
			</div> <!-- /. class="form-group" -->

		</div> <!-- /. class="box-body" -->

		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('plants.show', $plant->id) }}"> Cancelar </a>
		</div> <!-- /. class="box-footer" -->
		
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection