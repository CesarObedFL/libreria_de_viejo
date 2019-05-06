@extends('layouts.theme')

@section('title', 'Registro de Préstamos')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content-header')
	<h1><div class="col-md-8"><strong> Devoluciones </strong></div></h1><hr>
@endsection

@section('content')


	@include('partials.errors')
  	
  	<div><h3>Elige un cliente</h3></div>
  	<hr>
	<form role="form" action="{{ route('loan.devolution') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="col-md-6">
				<label for="client"> Cliente: </label>
		        <select class="form-control select2" style="width:100%;" name="clientID" id="clientID" value="{{ old('clientID') }}" required>
		        	@foreach($CLIENTS as $client)
		        		<option value="{{ $client->id }}"> {{ $client->getInfo() }}</option>
		        	@endforeach
				</select>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block" id="btnAccept"> Aceptar </button>
			<a class="btn btn-danger btn-block" href="{{ route('loan.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection