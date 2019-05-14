@extends('layouts.theme')

@section('title', 'Registro de Trueques')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Trueques </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<div class="input-group">
		<input type="hidden" name="route" id="route" value="/swap/search/book">
		<input class="form-control" type="text" name="isbn" id="isbn" placeholder="Introduce el ISBN a buscar...">
		<span class="input-group-btn">
			<button class="btn btn-success" type="submit" name="btnIn" id="btnIn"><i class="fa fa-plus-square"> Entrante </i></button>
		</span>
		<span class="input-group-btn">
			<button class="btn btn-danger" type="submit" name="btnOut" id="btnOut"><i class="fa fa-minus-square"> Saliente </i></button>
		</span>
	</div>

	<br>
	<div class="box">
		<div class="box-header"><h3 class="box-title">Libros Salientes</h3></div>
		<div class="box-body no-padding">
			<table class="table table-hover text-center" id="outProductsTable">
		        <thead>
		            <tr class="danger">
		            	<th style="width:5%"> </th>
		                <th style="width:15%"> ISBN </th>
		                <th style="width:40%"> Título </th>
		                <th style="width:10%"> Precio </th>
		                <th style="width:10%"> Cantidad </th>
		                <th style="width:10%"> Stock </th>
		                <th style="width:10%"> </th>
		            </tr>
		        </thead>
		        <tbody>
		            {{-- TABLA GENERADA CON JQUERY --}}
		        </tbody>
			</table>
		</div>
	</div>

	<div class="box">
		<div class="box-header"><h3 class="box-title">Libros Entrantes</h3></div>
		<div class="box-body no-padding">
			<table class="table table-hover text-center" id="inProductsTable">
		        <thead>
		            <tr class="success">
		            	<th style="width:5%"> </th>
		                <th style="width:15%"> ISBN </th>
		                <th style="width:50%"> Título </th>
		                <th style="width:10%"> Precio </th>
		                <th style="width:10%"> Cantidad </th>
		                <th style="width:10%"> </th>
		            </tr>
		        </thead>
		        <tbody>
		        	{{-- TABLA GENERADA CON JQUERY --}}
		        </tbody>
			</table>
		</div>
	</div>

	<form role="form" action="{{ route('swap.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="form-group col-md-6">
				<label for="total"> Total: </label>
				<input class="form-control" type="text" name="total" id="total" value="{{ old('total') }}" readonly >
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label for="pay"> Pago: </label>
					<input class="form-control" type="text" name="pay" id="pay" value="" onblur="validatePay();" required>
				</div>
			</div>
			<input type="hidden" name="inProducts" id="inProducts" value="">
			<input type="hidden" name="outProducts" id="outProducts" value="">
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-block" type="submit" id="btnAccept"> Realizar </button>
			<a class="btn btn-danger btn-block" href="{{ route('swap.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
	<script src="{{ asset('js/swaps/events.js') }}"></script>
	<script src="{{ asset('js/swaps/addProduct.js') }}"></script>
	<script src="{{ asset('js/swaps/cancelProduct.js') }}"></script>
	<script src="{{ asset('js/swaps/validations.js') }}"></script>
	<script src="{{ asset('js/swaps/calculateTotal.js') }}"></script>
@endsection