@extends('layouts.theme')

@section('title', 'Libros')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. del Préstamo</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.success')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ $LOAN->client->getInfo() }} </h1>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Fecha de Salida:</dt><dd>{{ $LOAN->getOutDate() }}</dd>
                        <dt>Fecha de Entrada:</dt><dd>{{ $LOAN->getInDate() }}</dd>
                        <dt>Adeudo:</dt><dd>{{ '$ '.$LOAN->getOwed() }}</dd>
                        <dt>Estatus:</dt><dd>{{ $LOAN->status }}</dd>
                        <dt>----------</dt><dd>----------</dd>
                        <dt>Usuario:</dt><dd>{{ $LOAN->user->getUser() }}</dd>
                    </dl>
                </div>
                {{-- LIBROS PRESTADOS --}}
                <div class="col-md-6">
                    <div class="box-group" id="accordion">
                        <div class="box-title">{{ "Libros Prestados: ".$LOAN->amount }}</div>
                        <div class="panel box box-primary">
                            @foreach($LOAN->borrowedbooks as $book)
                                <div class="box-header with-border">
                                    <div class="pull-right">
                                        <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $book->id }}" align="pull-right"> <i>ver detalles</i> </a></b>
                                    </div>
                                    {{ 'ID: '.$book->bookID }}
                                </div>
                                <div id="collapse{{ $book->id }}" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <dl class="dl-horizontal">
                                            <dt>Título:</dt><dd>{{-- $book->book->title --}}</dd>
                                            <dt>Autor:</dt><dd>{{-- $book->book->author --}}</dd>
                                            <dt>Editorial:</dt><dd>{{-- $book->book->editorial --}}</dd>
                                            <dt>Edición:</dt><dd>{{-- $book->book->edition --}}</dd>
                                            <dt>Clasificación:</dt><dd>{{-- 'class' --}}</dd>
                                        </dl>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> {{-- LIBROS PRESTADOS --}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-6" href="{{ route('loan.index') }}"> Aceptar </a>
                </div>
            </div>
        </div>
    </div>
@endsection