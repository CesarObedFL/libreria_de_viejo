@extends('layouts.theme')

@section('title', 'Registro de Préstamos')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Préstamos </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors') 

	<div class="input-group">
		<input class="form-control" type="text" name="isbn" id="isbn" placeholder="Introduce el ISBN a prestar...">
		<input type="hidden" name="route" id="route" value="/borrow/search/book">
		<span class="input-group-btn">
			<button class="btn btn-flat" type="submit" name="btnAddBook" id="btnAddBook">
				<i class="fa fa-search"></i>
			</button>
		</span>
	</div>
	<hr>

	@include('partials.errors')

  	<div class="box" style="width:100%;">
  		<div class="box-header"><h3 class="box-title">Libros a Prestar</h3></div>
      	<div class="box-body no-padding">
			<table class="table table-condensed text-center" id="productsTable">
		        <thead>
		            <tr class="success">
		            	<th style="width:5%"></th>
		                <th style="width:15%"> ISBN </th>
		                <th style="width:50%"> Título </th>
		                <th style="width:10%"> Cantidad </th>
		                <th style="width:10%"> Stock </th>
		                <th style="width:10%"></th>
		            </tr>
		        </thead>
		        <tbody>
		            {{--  TABLA GENERADA CON JQUERY --}} 
		        </tbody>
			</table>
		</div>
	</div>

	<hr>
	<form role="form" action="{{ route('borrows.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="col-md-6">
				<label for="client"> Cliente: </label>
		        <select class="form-control select2" style="width:100%;" name="client_id" id="client_id" value="{{ old('client_id') }}" required>
		        	@foreach($clients as $client)
		        		<option value="{{ $client->id }}"> {{ $client->getInfo() }}</option>
		        	@endforeach
				</select>
			</div>
      		<input type="hidden" name="products" id="products" value="">
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-block" type="submit" id="btnAccept" disabled="disabled"> Aceptar </button>
			<a class="btn btn-danger btn-block" href="{{ route('borrows.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
	<script src="{{ asset('js/borrows/events.js') }}"></script>
	<script src="{{ asset('js/borrows/addProduct.js') }}"></script>
	<script src="{{ asset('js/borrows/cancelProduct.js') }}"></script>
	<script src="{{ asset('js/borrows/validations.js') }}"></script>
@endsection