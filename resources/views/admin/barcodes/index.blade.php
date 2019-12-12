@extends('layouts.theme')

@section('title','Códigos de Barras')

@section('content-header')
	<h1><div class="col-md-8"><strong>Códigos de Barras</strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.errors')

	<div class="input-group">
		<input class="form-control" type="text" name="booktitle" id="booktitle" placeholder="Introduce el título del libro con el código a clonar...">
		<input type="hidden" name="route" id="route" value="/admin/search/book">
		<span class="input-group-btn">
			<button class="btn btn-flat" type="submit" name="btnAddBook" id="btnAddBook">
				<i class="fa fa-search"></i>
			</button>
		</span>
	</div>
	<hr>

	<div class="box" style="width:100%;">
	  	<div class="box-header"><h3 class="box-title">Códigos a Clonar</h3></div>
	      <div class="box-body no-padding">
	        	<table class="table table-condensed text-center" id="codesTable">
	          	<thead>
	              <tr class="success">
	              		<th style="width:10%"></th>
	              		<th style="width:40%">Título</th>
	            		<th style="width:30%">ISBN</th>
	            		<th style="width:10%">Cantidad</th>
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

	<form role="form" action="{{ route('admin.pdf') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<div class="form-group col-md-12">
				<label for="pages"> Número de Páginas: </label>
				<input type="number" class="form-control" id="pages" name="pages" min="1" max="5" value=1>
			</div>
			<input type="hidden" name="books" id="books" value="">
		</div>
		<div class="box-footer">
			<div class="col-md-6">
				<button type="submit" class="btn btn-primary btn-block" id="btnAccept">
				<i class="fa fa-download"></i> Generar </button>
			</div>
			<div class="col-md-6">
				<a class="btn btn-danger btn-block" href="{{ route('home') }}"> Cancelar </a>
			</div>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
	<script src="{{ asset('js/barcodes/events.js') }}"></script>
	<script src="{{ asset('js/barcodes/addProduct.js') }}"></script>
	<script src="{{ asset('js/barcodes/cancelProduct.js') }}"></script>
	<script src="{{ asset('js/barcodes/validations.js') }}"></script>
@endsection