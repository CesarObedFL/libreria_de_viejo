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
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('feature.newFeature', $BOOK->ID) }}"> Nueva Entrada </a>
                </div>
                <h1 class="box-title"> <strong>{{ '#'.$BOOK->ID }} : {{ $BOOK->title }} </strong></h1>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>ISBN:</dt><dd>{{ $BOOK->ISBN }}</dd>
                        <dt>Autor:</dt><dd>{{ $BOOK->author }}</dd>
                        <dt>Editorial:</dt><dd>{{ $BOOK->editorial }}</dd>
                        <dt>Clasificación:</dt><dd>{{ $BOOK->getClassification($BOOK->classification) }}</dd>
                        <dt>Ubicación:</dt><dd>{{ $BOOK->getLocation($BOOK->classification) }}</dd>
                        <dt>Género:</dt><dd>{{ $BOOK->genre }}</dd>
                        <dt>Colección:</dt><dd>{{ $BOOK->collection }}</dd>
                        <dt>Stock Total:</dt><dd>{{ $BOOK->getTotalStock($BOOK->ID) }}</dd>
                    </dl>
                </div>

                        
                {{-- CARACTERÍSTICAS DE LOS LIBROS - MODIFICAR Y ELIMINAR --}}
                <div class="col-md-6">
                    <div class="box-group" id="accordion">
                        <div class="box-title">ENTRADAS : Características del libro </div>
                        <div class="panel box box-primary">
                            @foreach($BOOK->features as $feature)
                                <div class="box-header with-border">
                                    <div class="pull-right">
                                        <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $feature->ID }}" align="pull-right"> ver detalles </a></b>
                                    </div>
                                    Precio: {{ "$ ".$feature->price }} &nbsp;::&nbsp; Condiciones: {{ $feature->conditions }} &nbsp;::&nbsp; Stock: {{ $feature->stock }} 
                                </div>
                                <div id="collapse{{ $feature->ID }}" class="panel-collapse collapse">
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
                                        <form role="form" action="{{ route('feature.destroy', $feature->ID) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <div class="box-footer">
                                                <a class="btn btn-success col-md-6" href="{{ route('feature.edit',$feature->ID) }}"> Editar </a>
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