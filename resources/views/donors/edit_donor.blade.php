@extends('layouts.theme')

@section('title', 'Edición de Contacto')

@section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Contacto : {{ $donor->id }} </strong></div></h1><hr>
@endsection

@section('content')
	
	@include('partials.errors')

	<form role="form" action="{{ route('donors.update', $donor->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group col-md-6">
				<label for="institution"> Institucion </label>
				<input class="form-control" type="text" name="institution" id="institution" value="{{ $donor->institution }}">
			</div>
			<div class="form-group col-md-6">
				<label for="contact"> Contacto </label>
				<input class="form-control" type="text" name="contact" id="contact" value="{{ $donor->contact }}" required>
			</div>
			<div class="form-group col-md-6">
				<label for="email"> Correo </label>
				<input class="form-control" type="email" name="email" id="email" value="{{ $donor->email }}">
			</div>
			<div class="form-group col-md-6">
				<label for="phone"> Teléfono </label>
				<input class="form-control" type="number" name="phone" id="phone" value="{{ $donor->phone }}">
			</div>
			<div class="form-group col-md-6">
				<label for="address"> Dirección </label>
				<input class="form-control" type="text" name="address" id="address" value="{{ $donor->address }}">
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="commercial_business"> Actividad </label>
					<input class="form-control" type="text" name="commercial_business" id="commercial_business" value="{{ $donor->commercial_business }}">
				</div>
			</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('donors.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection