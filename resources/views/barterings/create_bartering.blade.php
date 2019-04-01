@extends('layouts.theme')

@section('title', 'Registro de Libros')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Trueques </strong></div></h1><hr>
@endsection

@section('content')

	<form action="#" method="get">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="Search...">
			<span class="input-group-btn">
				<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</form>

	@include('partials.errors')

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

	<form role="form" action="{{ route('home') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="form-group col-md-12">
				<label for="ISBN"> ISBN </label>
				<input class="form-control" type="text" name="ISBN" id="ISBN" value="{{ old('ISBN') }}">
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="title"> Título </label>
					<input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
				</div>
				<input class="form-control" type="hidden" name="status" id="status" value="1">
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Realizar </button>
			<a class="btn btn-danger btn-block" href="{{ route('home') }}"> Cancelar </a>
		</div>
	</form>

@endsection