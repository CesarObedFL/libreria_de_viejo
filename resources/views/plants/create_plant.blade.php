@extends('layouts.theme')

@section('title', 'Registro de Plantas')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Plantas </strong></div></h1><hr>
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

	<form role="form" action="{{ route('plant.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="form-group col-md-12">
				<label for="name"> Nombre: </label>
				<input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
			</div>
			<div class="form-group">
				<div class="col-md-8">
					<label for="tips"> Recomendaciones: </label>
					<input class="form-control" type="text" name="tips" id="tips" value="{{ old('tips') }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label for="classification"> Clasificación: </label>
	                <select class="form-control select2" style="width:100%;" name="classification" id="classification" value="{{ old('classification') }}">
	                  	<option value="" selected="disabled"> </option>
	                  	@foreach($CLASSES as $CLASS)
	                  		<option value="{{ $CLASS->id }}"> {{ $CLASS->class }} </option>
						@endforeach
					</select>
            	</div>
            	<div class="col-md-3">
					<label for="stock"> Cantidad: </label>
					<input class="form-control" type="text" name="stock" id="stock" value="{{ old('stock') }}">
				</div>
				<div class="col-md-3">
					<label for="price"> Precio: </label>
					<div class="input-group">
						<span class="input-group-addon"> $ </span>
						<input class="form-control" type="text" name="price" id="price" value="{{ old('price') }}">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="image"> Imagen: </label>
					<input class="form-control" type="file" name="image" id="image" value="{{ old('image') }}">
					<!-- <input class="form-control" type="text" name="image" id="image" value="{ { old('image') }}"> -->
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Registrar </button>
			<a class="btn btn-danger btn-block" href="{{ route('plant.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection