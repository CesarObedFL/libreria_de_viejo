@extends('layouts.theme')

@section('title', 'Realizar Venta')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content-header') 
	<h1><div class="col-md-8"><strong> Realizar Venta </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

  <div class="col-md-6">
    <!-- <form action="{ { route('SearchBook') }}" method="get"> -->
      <div class="input-group">
        <input class="form-control" type="text" name="isbn" id="isbn" placeholder="Introduce el ISBN a vender...">
        <input type="hidden" name="route" id="route" value="/searchBook">
        <span class="input-group-btn">
          <button class="btn btn-flat" type="submit" name="btnAddBook" id="btnAddBook">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    <!-- </form> -->
  </div>
  <div class="col-md-6">
    <!-- <form action="{ { route('SearchPlant') }}" method="get"> -->
      <div class="input-group">
        <select class="form-control select2" style="width:100%;" name="plantID" id="plantID" value="{{ old('plantID') }}">
          <option value="none" selected="disabled">Selecciona la planta a vender...</option>
          @foreach($PLANTS as $plant)
            <option value="{{ $plant->id }}">{{ $plant->getInfo() }}</option>
          @endforeach
        </select>
        <span class="input-group-btn">
          <button type="submit" class="btn btn-flat" name="btnAddPlant" id="btnAddPlant"><i class="fa fa-search"></i></button>
        </span>
      </div>
    <!-- </form> -->
  </div>
  <br><hr>

  <div class="box" style="width:100%;">
  	<div class="box-header"><h3 class="box-title">Productos a Vender</h3></div>
      <div class="box-body no-padding">
        	<table class="table table-condensed text-center" id="productsTable">
          	<thead>
              <tr class="success">
                <th style="width:5%"></th>
            		<th style="width:15%">ISBN o ID</th>
                <th style="width:30%">Título o Nombre</th>
             		<th style="width:10%">Precio</th>
            		<th style="width:10%">Cantidad</th>
            		<th style="width:10%">Descuento<small>(%)</small></th>
            		<th style="width:10%">Stock</th>
            		<th style="width:10%"></th>
              </tr>
          	</thead>
            <tbody> 
                {{--  TABLA GENERADA CON JQUERY --}} 
            </tbody>
          </table>
      </div>
  </div>
  <br>
  <hr>
	<form role="form" action="{{ route('sale.store') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="col-md-4">
				<label for="client"> Cliente: </label>
        <select class="form-control select2" style="width:100%;" name="clientID" id="clientID" value="{{ old('clientID') }}">
          @foreach($CLIENTS as $client)
            <option value="{{ $client->ID }}">{{ $client->getInfo() }}</option>
          @endforeach
			  </select>
      </div>
      <div class="col-md-4">
				<label for="pay"> Total: </label>
        <div class="input-group">
          <span class="input-group-addon"> $ </span>
				  <input class="form-control" type="text" name="total" id="total" value="{{ old('total') }}" readonly required>
        </div>
			</div>
      <div class="col-md-4">
				<label for="pay"> Pago: </label>
        <div class="input-group">
          <span class="input-group-addon"> $ </span>
				  <input class="form-control" type="text" name="pay" id="pay" value="{{ old('pay') }}" onblur="validatePay();" required>
        </div>
			</div>
      <input type="hidden" name="products" id="products" value="">
		</div>
		<div class="box-footer">
			<div class="form-group col-md-4">
				<button type="submit" class="btn btn-primary btn-block" id="btnAccept" disabled="disabled"> Aceptar </button>
			</div>
			<div class="form-group col-md-4">
				<a href="#" class="btn btn-success btn-block"> Limpiar </a>
			</div>
			<div class="form-group col-md-4">
				<a class="btn btn-danger btn-block" href="{{ route('home') }}"> Cancelar </a>
			</div>
		</div>
	</form>

@endsection

@section('scripts')
  <script src="{{ asset('js/functions/typeNumber.js') }}"></script>
  <script src="{{ asset('js/actions/events.js') }}"></script>
  <script src="{{ asset('js/actions/validations.js') }}"></script>
  <script src="{{ asset('js/actions/addProduct.js') }}"></script>
  <script src="{{ asset('js/actions/cancelProduct.js') }}"></script>
  <script src="{{ asset('js/actions/calculateTotal.js') }}"></script>
@endsection