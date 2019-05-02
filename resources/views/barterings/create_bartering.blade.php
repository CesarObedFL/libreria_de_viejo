@extends('layouts.theme')

@section('title', 'Registro de Trueques')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Trueques </strong></div></h1><hr>
@endsection

@section('content')

	<form action="#" method="get">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="Introduce el ISBN a buscar">
			<span class="input-group-btn">
				<button type="submit" name="search" id="search" class="btn btn-success"><i class="fa fa-plus-square"> Entrante </i></button>
			</span>
			<span class="input-group-btn">
				<button type="submit" name="search" id="search" class="btn btn-danger"><i class="fa fa-minus-square"> Saliente </i></button>
			</span>
		</div>
	</form>

	@include('partials.errors')

	<br>
	<div class="box">
		<div class="box-header"><h3 class="box-title">Libros Salientes</h3></div>
		<div class="box-body no-padding">
			<table class="table table-hover text-center">
		        <thead>
		            <tr class="danger">
		                <th> ISBN </th>
		                <th> Título </th>
		                <th> Cantidad </th>
		                <th> Stock </th>
		                <th> Precio </th>
		            </tr>
		        </thead>
		        <tbody>
		            <!-- @ foreach($CLASSES as $class)
		            <tr>
		                <td><a class="btn btn-sm btn-block btn-info bg-olive" href="{ { route('classification.show', $class->id) }}">{ { $class->class }}</a></td>
		                <td>{ { $class->location }}</td>
		                <td>{ { $class->type }}</td>
		            </tr>
		            @ endforeach -->
		        </tbody>
			</table>
		</div>
	</div>

	<div class="box">
		<div class="box-header"><h3 class="box-title">Libros Entrantes</h3></div>
		<div class="box-body no-padding">
			<table class="table table-hover text-center">
		        <thead>
		            <tr class="success">
		                <th> ISBN </th>
		                <th> Título </th>
		                <th> Cantidad </th>
		            </tr>
		        </thead>
		        <tbody>
		            <!-- @ foreach($CLASSES as $class)
		            <tr>
		                <td><a class="btn btn-sm btn-block btn-info bg-olive" href="{ { route('classification.show', $class->id) }}">{ { $class->class }}</a></td>
		                <td>{ { $class->location }}</td>
		                <td>{ { $class->type }}</td>
		            </tr>
		            @ endforeach -->
		        </tbody>
			</table>
		</div>
	</div>

	<form role="form" action="{{ route('home') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="form-group col-md-6">
				<label for="total"> Total: </label>
				<input class="form-control" type="text" name="total" id="total" value="{{ old('total') }}" readonly >
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="pay"> Pago: </label>
					<input class="form-control" type="text" name="pay" id="pay" value="{{ old('pay') }}">
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Realizar </button>
			<a class="btn btn-danger btn-block" href="{{ route('bartering.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection