@extends('layouts.theme')

@section('title', 'Plantas')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. de Planta</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.error')
    @include('partials.edit')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ $PLANT->name }} </h1>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Precio:</dt><dd>{{ "$ ".$PLANT->price }}</dd>
                        <dt>Imagen:</dt><dd>{{ $PLANT->image }}</dd>
                        <dt>Clase:</dt><dd>{{ $PLANT->getClassification($PLANT->classification) }}</dd>
                        <dt>Recomendaciones:</dt><dd>{{ $PLANT->tips }}</dd>
                        <dt>Cantidad:</dt><dd>{{ $PLANT->stock }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">

                    IMAGEN
                    <!-- <img src="{ { Storage::url($plant->image) }}" width="50%"></a>-->
                </div>
            </div>
        </div>
        <div class="col-md-13">
            <div class="box box-primary">
                <form role="form" action="{{ route('plant.destroy', $PLANT->ID) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="box-footer">
                        <a class="btn btn-primary col-md-4" href="{{ route('plant.index') }}"> Aceptar </a>
                        <a class="btn btn-success col-md-4" href="{{ route('plant.edit', $PLANT->ID) }}"> Editar </a>
                        <button type="submit" class="btn btn-danger col-md-4"> Eliminar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection