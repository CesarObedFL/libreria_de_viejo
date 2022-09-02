@extends('layouts.theme')

@section('title', 'Edición de Password')

@section('content-header')
	<h1><div class="col-md-8"><strong> Cambiar Password de Usuario : {{ $USER->name }} </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('user.updatePass', $USER->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group col-md-12">
				<label for="password"> Nuevo Password </label>
				<input type="password" class="form-control" id="password" name="password">
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('users.show', $USER->id) }}"> Cancelar </a>
		</div>
	</form>

@endsection