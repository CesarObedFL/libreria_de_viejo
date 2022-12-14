@extends('layouts.theme')

@section('title', 'Actualización de Libro')

@section('content-header')
	<h1><div class="col-md-8"><strong> Actualización de Libro </strong></div></h1><hr>
@endsection

@section('content')

	@include('partials.edit')
	@include('partials.errors') 

	{{-- FORMULARIO PARA LA ACTUALIZACIÓN DEL STOCK DE UN LIBRO YA REGISTRADO  --}}

	<form role="form" action="{{ route('book.updateStock') }}" method="POST">
		{{ csrf_field() }}
		<div class="box-body">
			<input name="_method" type="hidden" value="PUT">

			<div class="col-md-12">
				<div> <label for="ISBN"> ISBN: </label> {{ $book->ISBN }} </div>
			</div> <!-- /. class="col-md-12" -->

			<div class="form-group col-md-6">
				<div> <label for="title"> Título: </label>{{ $book->title }} </div>
				<div> <label for="author"> Autor: </label>{{ $book->author }} </div>
			</div> <!-- /. class="form-group col-md-6" -->

			<div class="form-group col-md-6">
				<div class="col-md-6">
					<label for="editorial"> Editorial: </label>{{ $book->editorial }}
				</div>
            	<div class="col-md-6">
					{{-- <label for="genre"> Género: </label>{{ $BOOK->genre }} --}}
					<label for="genre"> Stock Actual: </label>{{ $book->stock }}
				</div>
				<div class="col-md-6">
					<label for="classification"> Clasificación: </label> {{ $book->classification->name }}
            	</div>
				<div class="col-md-6">
					{{-- <label for="collection"> Colección: </label>{{ $book->collection }} --}}
					<label for="collection"> Precio: </label>{{ ' $ '.$book->price }} 
				</div>
			</div> <!-- /. class="form-group col-md-6" -->

			{{-- SI YA EXISTE EL LIBRO SE ELIGE LAS CARACATERÍSTICAS A INGRESAR --}}
			<div class="form-group">
				CARACTERÍSTICAS <hr class="col-xs-10 pull-right">
			</div>
            <div class="col-md-6"> {{-- CARACTERÍSTICAS DE LOS LIBROS - MODIFICAR Y ELIMINAR --}}
                <div class="box-group" id="accordion">
                    <div class="box-title">
						ENTRADAS : Características registradas del libro
					</div>
                    <div class="panel box box-primary">
                        @foreach($book->features as $feature)
                            <div class="box-header with-border">
                                <div class="pull-right">
                                    <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $feature->id }}" align="pull-right"> ver detalles </a></b>
                                    <input type="radio" name="featureID" class="minimal" value="{{ $feature->id }}"required>
                                </div>
                                Condiciones: {{ $feature->conditions }} &nbsp;::&nbsp; Stock: {{ $feature->stock }}
                            </div> <!-- /. class="box-header with-border" -->
                            <div id="collapse{{ $feature->id }}" class="panel-collapse collapse">
                                <div class="box-body">
                                    <dl class="dl-horizontal">
                                    	<dt>Precio:</dt><dd>{{ "$ ".$feature->price }}</dd>
                                        <dt>Edición:</dt><dd>{{ $feature->edition }}</dd>
                                        <dt>Lenguaje:</dt><dd>{{ $feature->language }}</dd>
                                        <dt>Lugar:</dt><dd>{{ $feature->place }}</dd>
                                        <dt>Estatus:</dt><dd>{{ $feature->status }}</dd>
                                    </dl>
                                </div> <!-- /. class="box-body" -->
                            </div> <!-- /. class="panel-collapse collapse" -->
                        @endforeach
                    </div> <!-- /. class="panel box box-primary" -->
                </div> <!-- /. class="box-group" id="accordion" -->
            </div> {{-- CARACTERÍSTICAS DE LOS LIBROS - MODIFICAR Y ELIMINAR --}}

            <div class="col-md-6">
            	<input name="book_id" type="hidden" value="{{ $book->id }}">
            	<label for="stock"> Nuevo Stock </label>
				<input class="form-control" type="text" name="stock" id="stock" value="{{ $book->stock + 1 }}" required="required">
            </div>

		</div> {{-- box-body --}}
		
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Actualizar </button>
			<a class="btn btn-danger btn-block" href="{{ route('books.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection