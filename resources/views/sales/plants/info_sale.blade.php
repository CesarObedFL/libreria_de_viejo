@extends('layouts.theme')

@section('title', 'Clasificaciones')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. de Clase</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.error')
    @include('partials.edit')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ $CLASS->id }} : {{ $CLASS->class }} </h1>
            </div>
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>Ubicación : </dt><dd>{{ $CLASS->location }}</dd>
                    <dt>Tipo : </dt><dd>{{ $CLASS->type }}</dd>
                </dl>
            </div>
        </div>
        <div class="col-md-13">
            <div class="box box-primary">
                <form role="form" action="{{ route('classification.destroy', $CLASS->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="box-footer">
                        <a class="btn btn-primary col-md-4" href="{{ route('classification.index') }}"> Aceptar </a>
                        <a class="btn btn-success col-md-4" href="{{ route('classification.edit', $CLASS->id) }}"> Editar </a>
                        <button type="submit" class="btn btn-danger col-md-4"> Eliminar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection