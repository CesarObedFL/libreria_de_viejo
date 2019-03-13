@extends('layouts.theme') 

@section('title', 'Venta de Libros')

@section('content-header')
	<h1><div class="col-md-8"><strong> Venta de Libros </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<form action="{{ route('SearchBook') }}" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="search_isbn" id="search_isbn" class="form-control" placeholder="Introduce el ISBN a vender...">
      <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat">
          <i class="fa fa-search"></i>
        </button>
      </span>
    </div>
  </form>
  <br>

  <div class="box">
  	<div class="box-header"><h3 class="box-title">Libros a Vender</h3></div>
      <div class="box-body no-padding">
        	<table class="table table-condensed">
          	<tr>
            		<th style="width:15%">ISBN</th>
            		<th style="width:35%">Título</th>
             		<th style="width:10%">Precio</th>
            		<th style="width:10%">Cantidad</th>
            		<th style="width:10%">Descuento</th>
            		<th style="width:10%">Stock</th>
            		<th style="width:10%"></th>
          	</tr>
          	{{-- @foreach($BooksToSell as $BOOK)) --}}
            @if(isset($BOOK))
          	<tr>
          		<td>{{ $BOOK->ISBN }}</td>
          		<td>{{ $BOOK->title }}</td>
          		<td></td>
          		<td><input class="form-control" name="amount" id="amount" value="{{ 0 }}"> </td>
          		<td><input class="form-control" name="discount" id="discount" value="{{ 0 }}"%></td>
          		<td>{{ /*$BOOK->getTotalStock($BOOK->id)*/0 }}</td>
          		<td><button class="btn btn-danger btn-block" name="cancel-product" id="cancel-product">X</td>
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
				<button type="submit" class="btn btn-primary btn-block"> Vender </button>
			</div>
			<div class="form-group col-md-4">
				<a class="btn btn-success btn-block"> Limpiar </a>
			</div>
			<div class="form-group col-md-4">
				<a class="btn btn-danger btn-block" href="{{ route('home') }}"> Cancelar </a>
			</div>
		</div>
	</form>

@endsection