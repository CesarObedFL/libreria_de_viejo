@extends('layouts.theme') 

@section('title', 'Venta de Plantas')

@section('content-header') 
	<h1><div class="col-md-8"><strong> Venta de Plantas </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form action="#{{-- route('SearchPlant') --}}" method="get" class="sidebar-form">
    <div class="input-group">
      <select class="form-control select2" style="width:100%;" name="product" id="product" value="{{ old('product') }}" required>
        <option value="" selected="disabled">Selecciona la planta a vender...</option>
        @foreach($PLANTS as $plant)
          <option value="{{ $plant->id }}_{{ $plant->name }}_{{ $plant->tips }}_{{ $plant->price }}_{{ $plant->stock }}">
            {{ $plant->name }} :: Stock: {{ $plant->stock }} :: Precio: {{ $plant->price }}
          </option>
        @endforeach
      </select>
      <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat btn-addProduct">
          <i class="fa fa-search"></i>
        </button>
      </span>
    </div>
  </form>
  <br>

  <div class="box">
  	<div class="box-header"><h3 class="box-title">Plantas a Vender</h3></div>
      <div class="box-body no-padding">
        	<table class="table table-condensed" id="products">
          	<thead>
            		<th style="width:20%">Nombre</th>
                <th style="width:30%">Recomendaciones</th>
             		<th style="width:10%">Precio</th>
            		<th style="width:10%">Cantidad</th>
            		<th style="width:10%">Descuento(%)</th>
            		<th style="width:10%">Stock</th>
            		<th style="width:10%"></th>
          	</thead>
          	{{-- @foreach($BooksToSell as $BOOK)) --} }
            @if(isset($PLANT))
          	{{-- <tr id="fila1"> --} }
            <tr data-id="{{ $PLANT->id }}">
          		<td>{{ $PLANT->name }}</td>
          		<td>{{ $PLANT->tips }}</td>
              <td><input class="form-control" name="price" id="price" value="{{ $PLANT->price }}"></td>
          		<td><input class="form-control" type="number" name="amount" id="amount" value="{{ 0 }}"> </td>
          		<td><input class="form-control" type="number" name="discount" id="discount" value="{{ 0 }}"></td>
          		<td>{{ $PLANT->stock }}</td>
          		
              {{--<td><button class="btn btn-danger btn-block" onclick="cancelProduct(1);" name="cancelProduct" id="cancelProduct">X</td>--}}
              {{-- btn-deleteProduct es la clase js para deletear un producto de la tabla--} }
              <td><button class="btn btn-danger btn-block btn-deleteProduct">X</td>

          	</tr>
            @endif
          	{{--@endforeach --}}
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
          <option value="" selected="disabled"> </option>
          @foreach($CLIENTS as $client)
            <option value="{{ $client->id }}"> {{ $client->name }} : {{ $client->email }}</option>
          @endforeach
			  </select>
      </div>
      <div class="col-md-4">
				<label for="pay"> Total: </label>
				<input class="form-control" type="text" name="total" id="total" value="{{ old('total') }}">
			</div>
      <div class="col-md-4">
				<label for="pay"> Pago: </label>
				<input class="form-control" type="text" name="pay" id="pay" value="{{ old('pay') }}">
			</div>
		</div>
		<div class="box-footer">
			<div class="form-group col-md-4">
				<button type="submit" class="btn btn-primary btn-block"> Aceptar </button>
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
  {{-- <script src="{{ asset('js/plants/cancelProduct.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/plants/addProduct.js') }}"></script> --}}
  <script src="{{ asset('js/plants/accionesPlantas.js') }}"></script>
@endsection