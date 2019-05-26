@extends('layouts.theme')

@section('title', 'Usuario')

@section('content-header')
    <h1><div class="col-md-8"><strong>Perfíl de Usuario</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.delete')
    @include('partials.edit')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ $USER->name }} </h1>
            </div>
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>ID:</dt><dd>{{ $USER->id }}</dd>
                    <dt>Correo:</dt><dd>{{ $USER->email }}</dd>
                    <dt>Telefono:</dt><dd>{{ $USER->phone }}</dd>
                    <dt>Rol:</dt><dd>{{ $USER->role }}</dd>
                    <dt>Fecha de Registro:</dt><dd>{{ date('d/m/Y',strtotime($USER->created_at)) }}</dd>
                </dl>
                <a href="{{ route('user.changepass',$USER->id) }}"><i> Cambiar Password </i></a>
            </div>
        </div>
        <div class="col-md-13">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-3" href="{{ route('user.index') }}"> Aceptar </a>
                    <a class="btn btn-success col-md-3" href="{{ route('user.edit',$USER->id) }}"> Editar </a>
                    <a class="btn btn-warning col-md-3" href="{{ route('user.role',$USER->id) }}"> Privilegios </a>
                    <form role="form" action="{{ route('user.destroy', $USER->id) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger col-md-3"> Eliminar </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
