@extends('layouts.theme')

@section('title', 'Pago')

@section('content-header')
	<h1><div class="col-md-8"><strong> Pago a: {{ $user->name }} </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('admin.update', $user->id) }}" method="POST">
		{{ csrf_field() }} 
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group col-md-12">
				<input name="owed" type="hidden" value="{{ $owed }}">
				<label for="owed"> Adeudo: {{ '$ '.$owed }} </label>
			</div>
			<div class="form-group col-md-12">
				<label for="payment"> Pago </label>
				<input type="text" class="form-control" id="payment" name="payment">
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('admin.cut') }}"> Cancelar </a>
		</div>
	</form>

@endsection