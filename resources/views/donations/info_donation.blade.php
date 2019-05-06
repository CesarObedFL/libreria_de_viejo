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
                <h1 class="box-title"> {{ $DONATION->id.' :: Donación '. $DONATION->type }} </h1>
                <!-- <i class="fa fa-text-width"></i> -->
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Fecha:</dt><dd>{{ $DONATION->getDate() }}</dd>
                        <dt>Cantidad de Libros:</dt><dd>{{ $DONATION->amount }}</dd>
                        <dt>Clasificación:</dt><dd>{{ $DONATION->getClass() }}</dd>
                        <dt>Usuario:</dt><dd>{{ $DONATION->user->getUser() }}</dd>
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
                                {{ $DONATION->getType() }}
                            </div>
                            <div id="collapse" class="panel-collapse collapse">
                                <div class="box-body">
                                    <dl class="dl-horizontal">
                                        <dt>Institución:</dt><dd>{{ $DONATION->donor->institution }}</dd>
                                        <dt>Contacto:</dt><dd>{{ $DONATION->donor->contact }}</dd>
                                        <dt>Correo:</dt><dd>{{ $DONATION->donor->email }}</dd>
                                        <dt>Teléfono:</dt><dd>{{ $DONATION->donor->phone }}</dd>
                                        <dt>Dirección:</dt><dd>{{ $DONATION->donor->address }}</dd>
                                        <dt>Giro:</dt><dd>{{ $DONATION->donor->commercialBusiness }}</dd>
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
                {{--
                <form role="form" action="{ { route('donation.destroy', $DONATION->id) }}" method="POST">
                    { { csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="box-footer">
                        <a class="btn btn-primary col-md-4" href="{ { route('donation.index') }}"> Aceptar </a>
                        <a class="btn btn-success col-md-4" href="{ { route('book.edit', $BOOK->id) }}"> Editar </a> - ->
                        <button type="submit" class="btn btn-danger col-md-4"> Eliminar </button>
                    </div>
                </form> 
                --}}
                <div class="box-footer">
                    <a class="btn btn-primary col-md-4" href="{{ route('donation.index') }}"> Aceptar </a>
                </div>
            </div>
        </div>
    </div>
@endsection