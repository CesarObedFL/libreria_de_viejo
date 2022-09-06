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
                        <dt>Clasificación:</dt><dd>{{ $PLANT->classification->name }}</dd>
                        <dt>Recomendaciones:</dt><dd>{{ $PLANT->tips }}</dd>
                        <dt>Stock:</dt><dd>{{ $PLANT->stock }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <!-- <img src="{ { Storage::url($plant->image) }}" width="50%"></a>-->
                </div>
            </div>
        </div>
        <div class="col-md-13">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-6" href="{{ route('plants.index') }}"> Aceptar </a>
                    <a class="btn btn-success col-md-6" href="{{ route('plants.edit', $PLANT->id) }}"> Editar </a>
                </div>
            </div>
        </div>
    </div>
@endsection