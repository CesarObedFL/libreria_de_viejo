@extends('layouts.theme')

@section('title', 'Usuarios')

@section('content-header')
	<h1>
		<div class="col-md-8"><strong>Lista de Usuarios</strong></div>
		<div class="col-md-4">
			<a class="btn btn-success btn-block pull-right" href="{{ route('user.create') }}">
			<i class="fa fa-barcode"></i> NUEVO REGISTRO </a>
		</div>
	</h1> <hr>
@endsection

@section('content')

	@include('partials.success')
	@include('partials.delete')

	@if($USERS->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i>No hay usuarios registrados...
            </div>
        </div>

	@else
		<table class="table table-hover text-center">
	        <thead>
	            <tr class="success">
	                <th> ID </th>
	                <th> Nombre </th>
	                <th> Rol </th>
	            </tr>
	        </thead>
	        <tbody>
	            @foreach($USERS as $user)
	            <tr>
	                <td><a class="btn btn-sm btn-block btn-info bg-olive" href="{{ route('user.show', $user->id) }}">{{ $user->id }}</a></td>
	                <td>{{ $user->name }}</td>
	                <td>{{ $user->role }}</td>
	            </tr>
	            @endforeach
	        </tbody>
		</table>
	@endif
@endsection