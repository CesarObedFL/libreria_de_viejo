@extends('layouts.theme')

@section('title', 'Donación')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. de la Donación</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.error')
    @include('partials.edit')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ $donation->id.' :: Donación '. $donation->type }} </h1>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Fecha:</dt><dd>{{ $donation->getDate() }}</dd>
                        <dt>Cantidad de Libros:</dt><dd>{{ $donation->amount }}</dd>
                        <dt>Clasificación:</dt><dd>{{ $donation->classification->name }}</dd>
                        <dt>Usuario:</dt><dd>{{ $donation->user->getUser() }}</dd>
                    </dl>
                </div>
                {{-- DONANTE | BENEFICIARIO --}}
                <div class="col-md-6">
                    <div class="box-group" id="accordion">
                        <div class="box-title"> Detalles </div>
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <div class="pull-right">
                                    <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse" align="pull-right"> ver </a></b>
                                </div>
                                {{ $donation->getType() }}
                            </div>
                            <div id="collapse" class="panel-collapse collapse">
                                <div class="box-body">
                                    <dl class="dl-horizontal">
                                        <dt>Institución:</dt><dd>{{ $donation->donor->institution }}</dd>
                                        <dt>Contacto:</dt><dd>{{ $donation->donor->contact }}</dd>
                                        <dt>Correo:</dt><dd>{{ $donation->donor->email }}</dd>
                                        <dt>Teléfono:</dt><dd>{{ $donation->donor->phone }}</dd>
                                        <dt>Dirección:</dt><dd>{{ $donation->donor->address }}</dd>
                                        <dt>Giro:</dt><dd>{{ $donation->donor->commercial_business }}</dd>
                                    </dl>
                                </div>
                                <div class="box-footer"> </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- DONANTE | BENEFICIARIO --}}
            </div> {{-- /BOX-BODY --}}
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-4" href="{{ route('donations.index') }}"> Aceptar </a>
                </div>
            </div>
        </div>
    </div>
@endsection