@extends('layouts.theme')

@section('title', 'Usuario')

@section('content-header')
    <h1><div class="col-md-8"><strong>Mi Perfil</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.error')
    @include('partials.edit')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ $USER->name }}</h1>
            </div>
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>ID:</dt><dd>{{ $USER->ID }}</dd>
                    <dt>Correo:</dt><dd>{{ $USER->email }}</dd>
                    <dt>Telefono:</dt><dd>{{ $USER->phone }}</dd>
                    <dt>Rol:</dt><dd>{{ $USER->role }}</dd>
                    <dt>Fecha de Registro:</dt><dd>{{ date('d/m/Y',strtotime($USER->created_at)) }}</dd>
                    <!--
                    <dt></dt><dd><i><a href="{ { route('user.role', $USER->id) }}"> Cambiar Password </a></i></dd> 
                    -->
                </dl>
            </div>
        </div>
        <div class="col-md-13">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-6" href="{{ route('home') }}"> Aceptar </a>
                    <a class="btn btn-success col-md-6" href="{{ route('user.edit', $USER->ID) }}"> Editar </a>
                </div>
            </div>
        </div>
    </div>

@endsection
