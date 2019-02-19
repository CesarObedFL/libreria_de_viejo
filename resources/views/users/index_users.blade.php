@extends('layouts.theme')

@section('title', 'Usuarios')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
      $(function () {
        $('#usersTable').DataTable({
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
		<div class="col-md-8"><strong>Lista de Usuarios</strong></div>
		<div class="col-md-4">
			<a class="btn btn-success btn-block pull-right" href="{{ route('user.create') }}">
			<i class="fa fa-barcode"></i> NUEVO REGISTRO </a>
		</div>
	</h1> <hr>
@endsection

@section('content')

	@include('partials.success')
	@include('partials.delete')

	@if($USERS->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i>No hay usuarios registrados...
            </div>
        </div>

	@else
		<table id="usersTable" class="table table-bordered table-striped">
	        <thead>
	            <tr class="success">
	                <th> ID </th>
	                <th> Nombre </th>
	                <th> Rol </th>
	            </tr>
	        </thead>
	        <tbody>
	            @foreach($USERS as $user)
	            <tr>
	                <td><a class="btn btn-sm btn-block btn-info bg-olive" href="{{ route('user.show', $user->id) }}">{{ $user->id }}</a></td>
	                <td>{{ $user->name }}</td>
	                <td>{{ $user->role }}</td>
	            </tr>
	            @endforeach
	        </tbody>
		</table>
	@endif
@endsection