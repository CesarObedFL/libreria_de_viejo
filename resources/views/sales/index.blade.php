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
        $('#sales_table').DataTable({
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
		<div class="box">
            <div class="box-header">
                <form role="form" action="{{ route('sales.index') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-md-4">
                            <label>Periodo: {{ date("d-m-Y",strtotime($start_date)) .' / '.date("d-m-Y",strtotime($end_date)) }}</label>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="start_date"> Fecha Inicial: </label>
                            <input type="date" name="start_date" id="start_date">
                            <label for="end_date"> Fecha Final: </label>
                            <input type="date" name="end_date" id="end_date">
                            <button type="submit" class="btn btn-primary btn-sm"> Buscar </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-body">
		        <table id="sales_table" class="table table-bordered table-striped">
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
			                <td><a class="btn btn-sm btn-block bg-olive" href="{{ route('sales.show', $invoice->id) }}">{{ $invoice->id }}</a></td>
			                <td>{{ $invoice->getDate() }}</td>
			                <td>{{ $invoice->turn }}</td>
			                <td>{{ $invoice->user['name'] }}</td>
			                <td>{{ '$ '.$invoice->subTotal }}</td>
			                <td>{{ '$ '.$invoice->total }}</td>
			                <td>{{ '$ '.$invoice->received }}</td>
			            </tr>
			            @endforeach
			        </tbody>
				</table>
			</div>
		</div>
	@endif
@endsection