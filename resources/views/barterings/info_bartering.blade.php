@extends('layouts.theme')

@section('title', 'Trueque')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. del Trueque</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.error')
    @include('partials.edit')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ $BARTER->id }} </h1>
                <!-- <i class="fa fa-text-width"></i> -->
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Fecha:</dt><dd>{{ $BARTER->date }}</dd>
                        <dt>Monto:</dt><dd>{{ '$ '.$BARTER->amounttopay }}</dd>
                        <dt>Usuario:</dt><dd>{{ $BARTER->userID }}</dd>
                    </dl>
                </div>

                {{-- LIBROS ENTRANTES Y SALIENTES --}}
                <div class="col-md-6">
                    <div class="box-group" id="accordion">
                        <div class="box-title">DETALLES : Libros Intercambiados </div>
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <div class="pull-right">
                                    <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse_in" align="pull-right"> ver </a></b>
                                </div>
                                {{ $BARTER->in }} Libros Entrantes
                            </div>
                            <div id="collapse_in" class="panel-collapse collapse">
                                <div class="box-body">
                                    <dl class="dl-horizontal">
                                        @foreach($BARTER->books_in as $book)
                                            <dt></dt><dd></dd>
                                        @endforeach
                                    </dl>
                                </div>
                                <div class="box-footer"> </div>
                            </div>

                            <div class="box-header with-border">
                                <div class="pull-right">
                                    <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse_out" align="pull-right"> ver </a></b>
                                </div>
                                {{ $BARTER->out }} Libros Salientes
                            </div>
                            <div id="collapse_out" class="panel-collapse collapse">
                                <div class="box-body">
                                    <dl class="dl-horizontal">
                                        @foreach($BARTER->books_out as $book)
                                            <dt></dt><dd></dd>
                                        @endforeach
                                    </dl>
                                </div>
                                <div class="box-footer"> </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- /LIBROS ENTRANTES Y SALIENTES --}}
            </div> {{-- /BOX-BODY --}}
        </div>
        <div class="col-md-13">
            <div class="box box-primary">
                <form role="form" action="{{ route('bartering.destroy', $BARTER->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="box-footer">
                        <a class="btn btn-primary col-md-4" href="{{ route('bartering.index') }}"> Aceptar </a>
                        <!-- <a class="btn btn-success col-md-4" href="{ { route('book.edit', $BOOK->ID) }}"> Editar </a> -->
                        <button type="submit" class="btn btn-danger col-md-4"> Eliminar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection