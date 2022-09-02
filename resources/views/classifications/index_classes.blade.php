@extends('layouts.theme')

@section('title', 'Clasificaciones')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
      $(function () {
        $('#classesTable').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true, 
          'info'        : true,
          'autoWidth'   : true
        })
      })
    </script>
@endsection

@section('content-header')
	<h1>
		<div class="col-md-8"><strong>Lista de Clasificaciones</strong></div>
		<div class="col-md-4">
			<a class="btn btn-success btn-block pull-right" href="{{ route('classifications.create') }}">
			<i class="fa fa-pencil-square-o"></i> NUEVO REGISTRO </a>
		</div>
	</h1> <hr>
@endsection

@section('content')

	@include('partials.success')
	@include('partials.delete')
	@include('partials.edit')

	@if($CLASSES->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i>No hay clasificaciones registradas...
            </div>
        </div>

	@else
        <table id="classesTable" class="table table-bordered table-striped">
	        <thead>
	            <tr class="success">
	                <th> Nombre </th>
	                <th> Tipo </th>
	                <th> Editar </th>
	                <th> Eliminar </th>
	            </tr>
	        </thead>
	        <tbody>
	            @foreach($CLASSES as $class)
	            <tr>
	                <td>{{ $class->class }}</a></td>
	                <td style="width:20%">{{ $class->type }}</td>
	                <td style="width:10%">
	                	<a class="btn btn-sm btn-block btn-info" href="{{ route('classifications.edit', $class->id) }}">  
	                	
	                	<i class="icon fa fa-pencil"></i></a>
	                </td>
	                <td style="width:10%">
	                	<form role="form" action="{{ route('classifications.destroy', $class->id) }}" method="POST">
		                    {{ csrf_field() }}
		                    <input type="hidden" name="_method" value="DELETE">
		                    <button type="submit" class="btn btn-sm btn-block btn-danger">
		                    	<i class="icon fa fa-trash"></i>
		                    </button>
		                </form>
	                </td>
	            </tr>
	            @endforeach
	        </tbody>
		</table>
	@endif
@endsection