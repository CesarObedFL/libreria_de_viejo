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
				<div> <label for="ISBN"> ISBN: </label> {{ $BOOK->ISBN }} </div>
			</div>
			<div class="form-group col-md-6">
				<div> <label for="title"> Título: </label>{{ $BOOK->title }} </div>
				<div> <label for="author"> Autor: </label>{{ $BOOK->author }} </div>
			</div>
			<div class="form-group col-md-6">
				<div class="col-md-6">
					<label for="editorial"> Editorial: </label>{{ $BOOK->editorial }}
				</div>
            	<div class="col-md-6">
					{{-- <label for="genre"> Género: </label>{{ $BOOK->genre }} --}}
					<label for="genre"> Stock Actual: </label>{{ $BOOK->stock }}
				</div>
				<div class="col-md-6">
					<label for="classification"> Clasificación: </label> {{ $BOOK->getClassification($BOOK->classification) }}
            	</div>
				<div class="col-md-6">
					{{-- <label for="collection"> Colección: </label>{{ $BOOK->collection }} --}}
					<label for="collection"> Precio: </label>{{ ' $ '.$BOOK->price }} 
				</div>
			</div>

			{{-- SI YA EXISTE EL LIBRO SE ELIGE LAS CARACATERÍSTICAS A INGRESAR --
			<div class="form-group">CARACTERÍSTICAS <hr class="col-xs-10 pull-right"></div>
            <div class="col-md-6">
                <div class="box-group" id="accordion">
                    <div class="box-title">ENTRADAS : Características registradas del libro</div>
                    <div class="panel box box-primary">
                        @foreach($BOOK->features as $feature)
                            <div class="box-header with-border">
                                <div class="pull-right">
                                    <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $feature->id }}" align="pull-right"> ver detalles </a></b>
                                    <input type="radio" name="featureID" class="minimal" value="{{ $feature->id }}"required>
                                </div>
                                Condiciones: {{ $feature->conditions }} &nbsp;::&nbsp; Stock: {{ $feature->stock }}
                            </div>
                            <div id="collapse{{ $feature->id }}" class="panel-collapse collapse">
                                <div class="box-body">
                                    <dl class="dl-horizontal">
                                    	<dt>Precio:</dt><dd>{{ "$ ".$feature->price }}</dd>
                                        <dt>Edición:</dt><dd>{{ $feature->edition }}</dd>
                                        <dt>Lenguaje:</dt><dd>{{ $feature->language }}</dd>
                                        <dt>Lugar:</dt><dd>{{ $feature->place }}</dd>
                                        <dt>Estatus:</dt><dd>{{ $feature->status }}</dd>
                                    </dl>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div> {{-- CARACTERÍSTICAS DE LOS LIBROS - MODIFICAR Y ELIMINAR --}}

            <div class="col-md-6">
            	<input name="bookID" type="hidden" value="{{ $BOOK->id }}">
            	<label for="stock"> Nueva Cantidad </label>
				<input class="form-control" type="text" name="stock" id="stock" value="{{ $BOOK->stock + 1 }}" required="required">
            </div>

		</div> {{-- box-body --}}
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-block"> Actualizar </button>
			<a class="btn btn-danger btn-block" href="{{ route('book.index') }}"> Cancelar </a>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/functions/typeNumber.js') }}"></script>
@endsection