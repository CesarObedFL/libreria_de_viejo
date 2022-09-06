@extends('layouts.theme')

@section('title', 'Libros')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. de Libro</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.error')
    @include('partials.edit')
    @include('partials.delete')
    @include('partials.success')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                {{--<div class="pull-right">
                    <a class="btn btn-success" href="{{ route('feature.newFeature', $BOOK->id) }}"> Nueva Entrada </a>
                </div>--}}
                <h1 class="box-title"> <strong>{{ '#'.$book->id }} : {{ $book->title }} </strong></h1>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>ISBN:</dt><dd>{{ $book->ISBN }}</dd>
                        <dt>Autor:</dt><dd>{{ $book->author }}</dd>
                        <dt>Editorial:</dt><dd>{{ $book->editorial }}</dd>
                        <dt>Clasificación:</dt><dd>{{ $book->classification->name }}</dd>
                        <dt>Estante:</dt><dd>{{ $book->getLocation() }}</dd>
                        <dt>Stock:</dt><dd>{{ $book->stock }}</dd>
                    </dl>
                </div>

                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Precio:</dt><dd>{{ '$ '.$book->price }}</dd>
                        <dt>Edición:</dt><dd>{{ $book->edition }}</dd>
                        <dt>Condiciones:</dt><dd>{{ $book->conditions }}</dd>
                        <dt>Género:</dt><dd>{{ $book->genre }}</dd>
                        <dt>Colección:</dt><dd>{{ $book->collection }}</dd>
                        <dt>Prestados:</dt><dd>{{ $book->borrowed_books }}</dd>
                    </dl>
                </div>

                        
                {{-- CARACTERÍSTICAS DE LOS LIBROS - MODIFICAR Y ELIMINAR --
                <div class="col-md-6">
                    <div class="box-group" id="accordion">
                        <div class="box-title">ENTRADAS : Características del libro </div>
                        <div class="panel box box-primary">
                            @foreach($book->features as $feature)
                                <div class="box-header with-border">
                                    <div class="pull-right">
                                        <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $feature->id }}" align="pull-right"> ver detalles </a></b>
                                    </div>
                                    Precio: {{ "$ ".$feature->price }} &nbsp;::&nbsp; Condiciones: {{ $feature->conditions }} &nbsp;::&nbsp; Stock: {{ $feature->stock }} 
                                </div>
                                <div id="collapse{{ $feature->id }}" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <dl class="dl-horizontal">
                                            <dt>Edición:</dt><dd>{{ $feature->edition }}</dd>
                                            <dt>Lenguaje:</dt><dd>{{ $feature->language }}</dd>
                                            <dt>Lugar:</dt><dd>{{ $feature->place }}</dd>
                                            <dt>Estatus:</dt><dd>{{ $feature->status }}</dd>
                                            <dt>Stock:</dt><dd>{{ $feature->stock }}</dd>
                                        </dl>
                                    </div>
                                    <div class="box-footer">
                                        <form role="form" action="{{ route('feature.destroy', $feature->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <div class="box-footer">
                                                <a class="btn btn-success col-md-6" href="{{ route('feature.edit',$feature->id) }}"> Editar </a>
                                                <button type="submit" class="btn btn-danger col-md-6"> Eliminar </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> {{-- CARACTERÍSTICAS DE LOS LIBROS - MODIFICAR Y ELIMINAR --}}

            </div> {{-- FIN BOX-BODY --}}
        </div>
        <div class="col-md-13">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-6" href="{{ route('books.index') }}"> Aceptar </a>
                    <a class="btn btn-success col-md-6" href="{{ route('books.edit', $book->id) }}"> Editar </a>
                </div>
            </div>
        </div>
    </div>
@endsection