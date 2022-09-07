@extends('layouts.theme')

@section('title', 'Edición de Usuario')

@section('content-header')
	<h1><div class="col-md-8"><strong> Cambiar Rol de Usuario : {{ $user->name }} </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form role="form" action="{{ route('user.updateRole', $user->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<div class="form-group col-md-12">
				<label for="privileges"> Privilegios Actuales: &nbsp&nbsp <i>{{ $user->role }} </i></label>
			</div> <!-- /. class="form-group col-md-12" -->
			<div class="form-group col-md-12">
				<p> Qué privilegios tendrá el usuario? &nbsp&nbsp&nbsp
					<input type="radio" name="role" value="3" class="flat-red">
					<label for="role"> Vendedor &nbsp&nbsp</label>
					<input type="radio" name="role" value="2" class="flat-red">
					<label for="role"> Supervisor &nbsp&nbsp</label>
					<input type="radio" name="role" value="1" class="flat-red">
					<label for="role"> Administrador </label>
				</p>
			</div> <!-- /. class="form-group col-md-12" -->
		</div> <!-- /. class="box-body" -->
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Guardar </button>
			<a class="btn btn-danger btn-block" href="{{ route('users.show', $user->id) }}"> Cancelar </a>
		</div> <!-- /. class="box-footer" -->
	</form>

@endsection