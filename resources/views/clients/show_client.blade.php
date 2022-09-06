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
                <h1 class="box-title"> {{ $client->id }} : {{ $client->name }} </h1>
            </div>
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>E-Mail:</dt><dd>{{ $client->email }}</dd>
                    <dt>Teléfono:</dt><dd>{{ $client->phone }}</dd>
                    <dt>Tipo:</dt><dd>{{ $client->type }}</dd>
                    <dt>Intereses:</dt><dd>{{ $client->interests }}</dd>
                </dl>
            </div>
        </div>
        <div class="col-md-13">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-6" href="{{ route('clients.index') }}"> Aceptar </a>
                    <a class="btn btn-success col-md-6" href="{{ route('clients.edit', $client->id) }}"> Editar </a>
                </div>
            </div>
        </div>
    </div>
@endsection