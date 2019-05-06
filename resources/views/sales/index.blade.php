@extends('layouts.theme')

@section('title', 'Ventas Realizadas')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
      $(function () {
        $('#ventasTable').DataTable({
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
		<div class="col-md-8"><strong>Ventas Realizadas</strong></div>
	</h1> <hr>
@endsection

@section('content')

	@include('partials.success')
	@include('partials.delete')

	@if($INVOICES->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i>No hay ventas realizadas...
            </div>
        </div>

	@else
        <table id="ventasTable" class="table table-bordered table-striped">
	        <thead>
	            <tr class="success">
	                <th> ID </th>
	                <th> Fecha </th>
	                <th> Turno </th>
	                <th> Vendedor </th>
	                <th> SubTotal </th>
	                <th> Total </th>
	                <th> Monto </th>
	            </tr>
	        </thead>
	        <tbody>
	            @foreach($INVOICES as $invoice)
	            <tr>
	                <td><a class="btn btn-sm btn-block btn-info bg-olive" href="{{ route('sale.show', $invoice->id) }}">{{ $invoice->id }}</a></td>
	                <td>{{ $invoice->getDate() }}</td>
	                <td>{{ $invoice->turn }}</td>
	                <td>{{ $invoice->user->name }}</td>
	                <td>{{ '$ '.$invoice->subTotal }}</td>
	                <td>{{ '$ '.$invoice->total }}</td>
	                <td>{{ '$ '.$invoice->received }}</td>
	            </tr>
	            @endforeach
	        </tbody>
		</table>
	@endif
@endsection