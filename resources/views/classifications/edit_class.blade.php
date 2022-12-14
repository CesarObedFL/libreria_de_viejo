@extends('layouts.theme')

@section('title', 'Edición de Clasificación')

@section('content-header')
    <h1><div class="col-md-8"><strong> Edición de Clasificación : {{ $class->id }}</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.errors')

    <form role="form" action="{{ route('classifications.update', $class->id) }}" method="POST">
        {{ csrf_field() }}
        <div class="box-body"> 
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group col-md-12">
                <label for="class"> Nombre </label> 
                <input type="text" class="form-control" id="name" name="name" value="{{ $class->name }}">
            </div> <!-- /. class="form-group col-md-12" -->
        </div> <!-- /. class="box-body" -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-block"> Guardar </button>
            <a class="btn btn-danger btn-block" href="{{ route('classifications.index') }}"> Cancelar </a>
        </div>  <!-- /. class="box-footer" -->
    </form>

@endsection