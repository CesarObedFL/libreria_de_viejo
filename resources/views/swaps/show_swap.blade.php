@extends('layouts.theme')

@section('title', 'Trueque')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. del Trueque</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.error')
    @include('partials.edit')
    @include('partials.success')
    @include('partials.balancedue')

    <div class="col-md-12">
        
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ 'ID: '.$swap->id }} </h1>
            </div> <!-- /. class="box-header with-border" -->

            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Fecha:</dt><dd>{{ $swap->getDate() }}</dd>
                        <dt>Monto:</dt><dd>{{ '$ '.$swap->amount_to_pay }}</dd>
                        <dt>Usuario:</dt><dd>{{ $swap->user->getUser() }}</dd>
                    </dl>
                </div> <!-- /. class="col-md-6" -->

                <div class="col-md-6"> {{-- LIBROS ENTRANTES Y SALIENTES --}}
                    <div class="box-group" id="accordion">
                        <div class="box-title">Libros Intercambiados </div>
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <div class="pull-right">
                                    <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse_in" align="pull-right"> ver </a></b>
                                </div>
                                {{ $swap->incoming_books.' Libros Entrantes' }}
                            </div> <!-- /. class="box-header with-border" -->

                            <div id="collapse_in" class="panel-collapse collapse">
                                <div class="box-body">
                                    <dl class="dl-horizontal">
                                        @foreach($swap->inbooks as $bbook)
                                            <dt>Título: </dt><dd>{{ $bbook->book->title }} - {{ $bbook->status }}</dd>
                                        @endforeach
                                    </dl>
                                </div> <!-- /. class="box-body" -->
                            </div> <!-- /. class="panel-collapse collapse" -->

                            <div class="box-header with-border">
                                <div class="pull-right">
                                    <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse_out" align="pull-right"> ver </a></b>
                                </div>
                                {{ $swap->outgoing_books. ' Libros Salientes' }}
                            </div> <!-- /. class="box-header with-border" -->

                            <div id="collapse_out" class="panel-collapse collapse">
                                <div class="box-body">
                                    <dl class="dl-horizontal">
                                        @foreach($swap->outbooks as $bbook)
                                            <dt>Título:</dt><dd>{{ $bbook->book->title }}</dd>
                                        @endforeach
                                    </dl>
                                </div> <!-- /. class="box-body" -->
                            </div> <!-- /. class="panel-collapse collapse" -->

                        </div> <!-- /. class="panel box box-primary" -->
                    </div> <!-- /. class="box-group" id="accordion" -->
                </div> {{-- /. LIBROS ENTRANTES Y SALIENTES --}}
            </div> {{-- /. class="box-body" --}}
        </div> <!-- /. class="box box-solid" -->

        <div class="col-md-13">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-6" href="{{ route('swaps.index') }}"> Aceptar </a>
                    <a class="btn btn-success col-md-6" href="{{ route('swaps.edit', $swap->id) }}"> Registrar pendientes </a>
                </div> <!-- /. class="box-footer" -->
            </div> <!-- /. class="box box-primary" -->
        </div> <!-- /. class="col-md-13" -->

    </div> <!-- /. class="col-md-12" -->
@endsection