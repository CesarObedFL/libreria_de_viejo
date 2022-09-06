@extends('layouts.theme')

@section('title', 'Devoluciones')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content-header')
	<h1><div class="col-md-8"><strong> {{ "Préstamo de ".$borrow->client->getInfo() }}  </strong></div></h1><hr>
@endsection

@section('content')

	<div class="input-group"> 
		<input class="form-control" type="text" name="isbn" id="isbn" placeholder="Introduce el ISBN del libro a devolver...">
		<input type="hidden" name="route" id="route" value="/devolution/search/book">
		<input type="hidden" name="borrow_id" id="borrow_id" value="{{ $borrow->id }}">
		<span class="input-group-btn">
			<button class="btn btn-flat" type="submit" name="btnAddBook" id="btnAddBook">
				<i class="fa fa-search"></i>
			</button>
		</span>
	</div>
	<hr>

	@include('partials.errors')
  
  	<div class="col-md-7">
	  	<div class="box" style="width:100%;">
	  		<div class="box-header"><h3 class="box-title">Libros Prestados</h3></div>
	      	<div class="box-body no-padding">
				<table class="table table-condensed" id="borrows_table">
			        <thead>
			            <tr class="info"> 
			                <th> Título </th>
			                <th style="width:10%"> Cantidad </th>
			            </tr>
			        </thead>
			        <tbody> 
		        		@foreach($borrow->borrowed_books as $bBook)
		        		<tr>
			        		<td>{{ $bBook->book->title }}</td>
			        		<td>{{ $bBook->amount }}</td>
			        	</tr>
		        		@endforeach
			        </tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="box" style="width:100%;">
			<div class="box-header"><h3 class="box-title">Libros a Devolver</h3></div>
			<div class="box-body no-padding">
				<table class="table table-condensed text-center" id="returnsTable">
					<thead>
						<tr class="success">
							<th style="width:60%">ISBN</th>
							<th style="width:20%">Cantidad</th>
							<th style="width:20%"></th>
						</tr>
					</thead>
					<tbody>
						{{-- TABLA GENERADA CON JQUERY --}}
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<hr>
	<div class="col-md-12">
	<form role="form" action="{{ route('borrows.update',$borrow->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PATCH">
			<input type="hidden" name="products" id="products" value="">
      		<div class="col-md-4">
				<label for="total"> Adeudo: </label>
        		<div class="input-group">
          			<span class="input-group-addon"> $ </span>
				  	<input class="form-control" type="text" name="total" id="total" value="{{ $borrow->getOwed() }}" readonly required>
        		</div>
			</div>
      		<div class="col-md-4">
				<label for="pay"> Pago: </label>
        		<div class="input-group">
          			<span class="input-group-addon"> $ </span>
				  	<input class="form-control" type="text" name="pay" id="pay" value="0" onblur="validatePay();" required>
        		</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block" id="btnAccept" disabled="disabled"> Aceptar </button>
			<a class="btn btn-danger btn-block" href="{{ route('borrows.show', $borrow->id) }}"> Cancelar </a>
		</div>
	</form>
	</div>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
	<script src="{{ asset('js/devolutions/events.js') }}"></script>
	<script src="{{ asset('js/devolutions/addProduct.js') }}"></script>
	<script src="{{ asset('js/devolutions/cancelProduct.js') }}"></script>
	<script src="{{ asset('js/devolutions/validations.js') }}"></script>
@endsection