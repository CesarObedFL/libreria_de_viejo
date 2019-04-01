@extends('layouts.theme') 

@section('title', 'Venta de Plantas')

@section('content-header') 
	<h1><div class="col-md-8"><strong> Venta de Plantas </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	{{--<form action="{{ route('SearchPlant') }}" method="get" class="sidebar-form">--}}

    <div class="input-group">
      <select class="form-control select2" style="width:100%;" name="product" id="product" value="{{ old('product') }}" required>
        <option value="none" selected="disabled">Selecciona la planta a vender...</option>
        @foreach($PLANTS as $plant)
          <option value="{{ $plant->id }}_{{ $plant->name }}_{{ $plant->tips }}_{{ $plant->price }}_{{ $plant->stock }}">
            {{ $plant->name }} :: Stock: {{ $plant->stock }} :: Precio: {{ $plant->price }}
          </option>
        @endforeach
      </select>
      <span class="input-group-btn">
        {{-- <button type="submit" name="search" class="btn btn-flat" id="btnAddProduct" {{-- id="search-btn"--} }> 
          <i class="fa fa-search"></i>
        </button> --}}
        <button class="btn btn-flat" id="btnAddProduct"><i class="fa fa-search"></i></button>
      </span>
    </div>
  {{-- </form> --}}
  <br>

  <div class="box" style="width:100%;">
  	<div class="box-header"><h3 class="box-title">Plantas a Vender</h3></div>
      <div class="box-body no-padding">
        	<table class="table table-condensed" id="products">
          	<thead>
                <th style="width:5%"></th>
            		<th style="width:15%">Nombre</th>
                <th style="width:30%">Recomendaciones</th>
             		<th style="width:10%">Precio</th>
            		<th style="width:10%">Cantidad</th>
            		<th style="width:10%">Descuento<small>(%)</small></th>
            		<th style="width:10%">Stock</th>
            		<th style="width:10%"></th>
          	</thead>
            <tbody> {{--  TABLA GENERADA CON JQUERY --}} </tbody>
          </table>
      </div>
  </div>
  <br>

	<form role="form" action="{{ route('home') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="col-md-4">
				<label for="client"> Cliente: </label>
        <select class="form-control select2" style="width:100%;" name="client" id="client" value="{{ old('client') }}">
          @foreach($CLIENTS as $client)
            <option value="{{ $client->id }}"> {{ $client->name }} : {{ $client->email }}</option>
          @endforeach
			  </select>
      </div>
      <div class="col-md-4">
				<label for="pay"> Total: </label>
				<input class="form-control" type="text" name="total" id="total" value="{{ old('total') }}" disabled >
			</div>
      <div class="col-md-4">
				<label for="pay"> Pago: </label>
				<input class="form-control" type="text" name="pay" id="pay" value="{{ old('pay') }}">
			</div>
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
  <script src="{{ asset('js/actions/plantActions.js') }}"></script>
  <script src="{{ asset('js/actions/validations.js') }}"></script>
  <script src="{{ asset('js/functions/alertMessage.js') }}"></script>
  <script src="{{ asset('js/functions/typeNumbers.js') }}"></script>
@endsection