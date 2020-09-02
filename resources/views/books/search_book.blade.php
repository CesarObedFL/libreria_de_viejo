@extends('layouts.theme')

@section('title', 'Registro de Libros')

@section('content-header')
	<h1><div class="col-md-8"><strong> Registro de Libros </strong></div></h1><hr>
@endsection

@section('content')

	<form action="{{ route('book.search') }}" method="get" class="sidebar-form">
    	<div class="input-group">
      		<input type="text" name="isbn" id="isbn" class="form-control" placeholder="Introduce el ISBN a registrar...">
      		<span class="input-group-btn">
	        	<button type="submit" name="search" id="search-btn" class="btn btn-flat">
	          		<i class="fa fa-search"></i>
	        	</button>
      		</span>
    	</div>
  	</form>

@endsection

@section('scripts')
  <script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection