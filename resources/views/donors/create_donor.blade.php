@extends('layouts.theme')

@section('title', 'Registro de Institución/Contacto')

@section('content-header')
	<h1>
		<div class="col-md-8"><strong> Registro de Institución / Contacto </strong></div>
    </h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('donors.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="form-group col-md-6">
				<label for="institution"> Institucion </label>
				<input class="form-control" type="text" name="institution" id="institution" value="{{ old('institution') }}">
			</div>
			<div class="form-group col-md-6">
				<label for="contact"> Contacto </label>
				<input class="form-control" type="text" name="contact" id="contact" value="{{ old('contact') }}" required>
			</div>
			<div class="form-group col-md-6">
				<label for="email"> Correo </label>
				<input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
			</div>
			<div class="form-group col-md-6">
				<label for="phone"> Teléfono </label>
				<input class="form-control" type="number" min=10000000 max=9999999999 name="phone" id="phone" value="{{ old('phone') }}">
			</div>
			<div class="form-group col-md-6">
				<label for="address"> Dirección </label>
				<input class="form-control" type="text" name="address" id="address" value="{{ old('address') }}">
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="commercialBusiness"> Actividad </label>
					<input class="form-control" type="text" name="commercialBusiness" id="commercialBusiness" value="{{ old('commercialBusiness') }}">
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