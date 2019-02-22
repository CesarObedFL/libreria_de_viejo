@extends('layouts.theme')

@section('title', 'Libros')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. de Libro</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.error')
    @include('partials.edit')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ $BOOK->title }} </h1>
                <!-- <i class="fa fa-text-width"></i> -->
            </div>
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>ISBN:</dt><dd>{{ $BOOK->ISBN }}</dd>
                    <dt>Autor:</dt><dd>{{ $BOOK->author }}</dd>
                    <dt>Editorial:</dt><dd>{{ $BOOK->editorial }}</dd>
                    <dt>Clasificación:</dt><dd>{{ $BOOK->classification }}</dd>
                    <dt>Ubicación:</dt><dd>{{ $BOOK->classification }}</dd>
                    <dt>Género:</dt><dd>{{ $BOOK->genre }}</dd>
                    <dt>Saga:</dt><dd>{{ $BOOK->saga }}</dd>
                    <dt>Colección:</dt><dd>{{ $BOOK->collection }}</dd>
                    <dt>Stock:</dt><dd>{{ $BOOK->stock }}</dd>
                    <dt>Registro:</dt><dd>{{ $BOOK->ID }}</dd>
                </dl>
            </div>
        </div>
        <div class="col-md-13">
            <div class="box box-primary">
                <form role="form" action="{{ route('book.destroy', $BOOK->ID) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="box-footer">
                        <a class="btn btn-primary col-md-4" href="{{ route('book.index') }}"> Aceptar </a>
                        <a class="btn btn-success col-md-4" href="{{ route('book.edit', $BOOK->ID) }}"> Editar </a>
                        <button type="submit" class="btn btn-danger col-md-4"> Eliminar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection