@extends('layouts.theme')

@section('title', 'Usuario')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. de Usuario : {{ $USER->id }} </strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.error')
    @include('partials.edit')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ $USER->getUserRoleAttribute() }} </h1>
            </div>
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>Correo:</dt><dd>{{ $USER->email }}</dd>
                    <dt>Telefono:</dt><dd>{{ $USER->phone }}</dd>
                    <dt>Fecha de Registro:</dt><dd>{{ date('d/m/Y',strtotime($USER->created_at)) }}</dd>
                </dl>
            </div>
        </div>
        <div class="col-md-13">
            <div class="box box-primary">
                <form role="form" action="{{ route('user.destroy', $USER->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="box-footer">
                        <a class="btn btn-primary col-md-3" href="{{ route('user.index') }}"> Aceptar </a>
                        <a class="btn btn-success col-md-3" href="{{ route('user.edit',$USER->id) }}"> Editar </a>
                        <a class="btn btn-warning col-md-3" href="{{ route('user.role',$USER->id) }}"> Privilegios </a>
                        <button type="submit" class="btn btn-danger col-md-3"> Eliminar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
