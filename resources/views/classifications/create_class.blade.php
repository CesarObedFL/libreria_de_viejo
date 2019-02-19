@extends('layouts.theme')

@section('title', 'Registro de Clasificaciones')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Clasificaciones </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('classification.store') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="form-group col-md-12">
				<label for="class"> Clase </label>
				<input type="text" class="form-control" id="class" name="class">
			</div>
			<div class="form-group col-md-12">
				<label for="location"> Ubicación </label>
				<input type="text" class="form-control" id="location" name="location">
			</div>
			<div class="form-group col-md-12">
				<p> Cuál es el tipo de la clase? &nbsp&nbsp&nbsp
					<input type="radio" name="type" value="1" class="flat-red">
					<label for="type"> Libro &nbsp&nbsp</label>
					<input type="radio" name="type" value="0" class="flat-red">
					<label for="type"> Planta </label>
				</p>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Registrar </button>
			<a class="btn btn-danger btn-block" href="{{ route('classification.index') }}"> Cancel </a>
		</div>
	</form>

@endsection