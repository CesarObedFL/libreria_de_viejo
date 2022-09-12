@extends('layouts.theme')

@section('title', 'Registro de Clasificaciones')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Clasificación </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('classifications.store') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="box-body"> 
			<div class="form-group col-md-12">
				<label for="class"> Clasificación: </label>
				<input type="text" class="form-control" id="name" name="name">
			</div> <!-- /. -->
			<div class="form-group col-md-12">
				<p> Tipo: &nbsp&nbsp&nbsp
					<input type="radio" name="type" value="Libro" class="flat-red">
					<label for="type"> Libro &nbsp&nbsp</label>
					<input type="radio" name="type" value="Planta" class="flat-red">
					<label for="type"> Planta </label>
				</p>
			</div> <!-- /. class="form-group col-md-12" -->
		</div> <!-- /. class="box-body" -->
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Registrar </button>
			<a class="btn btn-danger btn-block" href="{{ route('classifications.index') }}"> Cancel </a>
		</div> <!-- /. class="box-footer" -->
	</form>

@endsection