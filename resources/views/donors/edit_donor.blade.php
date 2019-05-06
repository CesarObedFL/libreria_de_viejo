@extends('layouts.theme')

@section('title', 'Edición de Contacto')

@section('content-header')
	<h1><div class="col-md-8"><strong> Edición de Contacto : {{ $DONOR->id }} </strong></div></h1><hr>
@endsection

@section('content')
	
	@include('partials.errors')

	<form role="form" action="{{ route('donor.update', $DONOR->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group col-md-6">
				<label for="institution"> Institucion </label>
				<input class="form-control" type="text" name="institution" id="institution" value="{{ $DONOR->institution }}">
			</div>
			<div class="form-group col-md-6">
				<label for="contact"> Contacto </label>
				<input class="form-control" type="text" name="contact" id="contact" value="{{ $DONOR->contact }}" required>
			</div>
			<div class="form-group col-md-6">
				<label for="email"> Correo </label>
				<input class="form-control" type="email" name="email" id="email" value="{{ $DONOR->email }}">
			</div>
			<div class="form-group col-md-6">
				<label for="phone"> Teléfono </label>
				<input class="form-control" type="number" min=10000000 max=9999999999 name="phone" id="phone" value="{{ $DONOR->phone }}">
			</div>
			<div class="form-group col-md-6">
				<label for="address"> Dirección </label>
				<input class="form-control" type="text" name="address" id="address" value="{{ $DONOR->address }}">
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="commercialBusiness"> Actividad </label>
					<input class="form-control" type="text" name="commercialBusiness" id="commercialBusiness" value="{{ $DONOR->commercialBusiness }}">
				</div>
			</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('donor.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection