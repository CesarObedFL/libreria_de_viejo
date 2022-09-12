@extends('layouts.theme')

@section('title', 'Registro de Donaciones')

@section('content-header')
	<h1>
		<div class="col-md-8"><strong> Registro de Donaciones </strong></div>
		<div class="col-md-4">
            <a class="btn btn-success btn-block pull-right" href="{{ route('donors.create') }}">
            <i class="fa fa-pencil-square-o"></i> NUEVA INSTITUCIÓN O CONTACTO </a>
        </div>
    </h1><hr>
@endsection

@section('content')

	@include('partials.errors') 

	<div class="box-header"><h3 class="box-title">{{ $title }}</h3></div>

	<form role="form" action="{{ route('donations.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">

			<div class="form-group col-md-12">
				<label for="donor"> Institucion o Contacto </label>
				<select class="form-control select2" name="donor_id" id="donor_id" value="{{ old('donor_id') }}">
					<option value="" selected="disabled"> </option>
					@foreach($donors as $donor)
						<option value="{{ $donor->id }}">{{ $donor->getDonor() }}</option>
					@endforeach
				</select>
			</div> <!-- /. class="form-group col-md-12" -->

			<div class="form-group col-md-6">
				<label for="amount"> Cantidad </label>
				<input class="form-control" type="number" min="1" name="amount" id="amount" value="{{ old('amount') }}">
			</div> <!-- /. class="form-group col-md-6" -->

			<div class="form-group">
				<div class="col-md-6">
					<label for="classification"> Clasificación </label>
					<select class="form-control select2" name="classification_id" id="classification_id" value="{{ old('classification_id')}}">
						<option value="" selected="disabled"> </option>
						@foreach($classes as $class)
							<option value="{{ $class->id }}">{{ $class->name }}</option>
						@endforeach
					</select>
				</div>
				<input class="form-control" type="hidden" name="type" id="type" value="{{ $type }}">
			</div> <!-- /. class="form-group" -->

		</div> <!-- /. class="box-body" -->

		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Realizar </button>
			<a class="btn btn-danger btn-block" href="{{ route('donations.index') }}"> Cancelar </a>
		</div> <!-- /. class="box-footer" -->
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection