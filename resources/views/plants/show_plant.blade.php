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
                <h1 class="box-title"> {{ $plant->name }} </h1>
            </div> <!-- /. class="box-header with-border" -->
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Precio:</dt><dd>{{ "$ ".$plant->price }}</dd>
                        <dt>Clasificación:</dt><dd>{{ $plant->classification->name }}</dd>
                        <dt>Recomendaciones:</dt><dd>{{ $plant->tips }}</dd>
                        <dt>Stock:</dt><dd>{{ $plant->stock }}</dd>
                    </dl>
                </div> 
                <div class="col-md-6">
                    <!-- <img src="{ { Storage::url($plant->image) }}" width="50%"></a>-->
                </div>
            </div> <!-- /. class="box-body" -->
        </div> <!-- /. class="box box-solid" -->

        <div class="col-md-13">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-6" href="{{ route('plants.index') }}"> Aceptar </a>
                    <a class="btn btn-success col-md-6" href="{{ route('plants.edit', $plant->id) }}"> Editar </a>
                </div>
            </div> <!-- /. class="box box-primary" -->
        </div> <!-- /. class="col-md-13" -->

    </div> <!-- /. class="col-md-12" -->
@endsection