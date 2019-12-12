@extends('layouts.theme')

@section('title', 'Pago')

@section('content-header')
	<h1><div class="col-md-8"><strong> Pago a: {{ $USER->name }} </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('admin.update', $USER->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group col-md-12">
				<input name="owed" type="hidden" value="{{ $OWED }}">
				<label for="owed"> Adeudo: {{ '$ '.$OWED }} </label>
			</div>
			<div class="form-group col-md-12">
				<label for="pay"> Pago </label>
				<input type="text" class="form-control" id="pay" name="pay">
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('admin.cut') }}"> Cancelar </a>
		</div>
	</form>

@endsection