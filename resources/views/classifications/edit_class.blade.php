@extends('layouts.theme')

@section('title', 'Edición de Clasificación')

@section('content-header')
    <h1><div class="col-md-8"><strong> Edición de Clasificación : {{ $CLASS->id }}</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.errors')

    <form role="form" action="{{ route('classifications.update', $CLASS->id) }}" method="POST">
        {{ csrf_field() }}
        <div class="box-body">
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group col-md-12">
                <label for="class"> Nombre </label> 
                <input type="text" class="form-control" id="class" name="class" value="{{ $CLASS->class }}">
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-block"> Guardar </button>
            <a class="btn btn-danger btn-block" href="{{ route('classifications.index') }}"> Cancelar </a>
        </div>
    </form>

@endsection