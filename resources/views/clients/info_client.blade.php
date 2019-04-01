@extends('layouts.theme')

@section('title', 'Clientes')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. de Cliente</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.error')
    @include('partials.edit')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ $CLIENT->id }} : {{ $CLIENT->name }} </h1>
            </div>
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>E-Mail:</dt><dd>{{ $CLIENT->email }}</dd>
                    <dt>Teléfono:</dt><dd>{{ $CLIENT->phone }}</dd>
                    <dt>Tipo:</dt><dd>{{ $CLIENT->type }}</dd>
                    <dt>Intereses:</dt><dd>{{ $CLIENT->interests }}</dd>
                </dl>
            </div>
        </div>
        <div class="col-md-13">
            <div class="box box-primary">
                <form role="form" action="{{ route('client.destroy', $CLIENT->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="box-footer">
                        <a class="btn btn-primary col-md-4" href="{{ route('client.index') }}"> Aceptar </a>
                        <a class="btn btn-success col-md-4" href="{{ route('client.edit', $CLIENT->id) }}"> Editar </a>
                        <button type="submit" class="btn btn-danger col-md-4"> Eliminar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection