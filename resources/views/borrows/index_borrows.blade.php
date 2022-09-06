@extends('layouts.theme')

@section('title', 'Préstamos')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

    <style>
        td.Activo { background-color: rgba(255,235,59,0.5); }
        td.Vencido { background-color: rgba(244,67,54,0.5); }
        td.Entregado { background-color: rgba(76,175,80,0.5); }
    </style>

@endsection

@section('scripts') 
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
      $(function () {
        $('#borrows_table').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        });
      });
    </script>
@endsection

@section('content-header')
    <h1>
        <div class="col-md-8"><strong>Préstamos Realizados</strong></div>
        <div class="col-md-4">
            <a class="btn btn-success btn-block pull-right" href="{{ route('borrows.create') }}">
            <i class="fa fa-pencil-square-o"></i> REALIZAR PRÉSTAMO </a>
        </div>
    </h1>
    <hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.delete')

    @if($borrows->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i> No hay préstamos registrados...
            </div>
        </div>
    
    @else
        <div class="box">
            <div class="box-header">
                <form role="form" action="{{ route('borrows.index') }}" method="GET">
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
                <table class="table table-condensed text-center" id="borrows_table">
                    <thead>
                        <tr class="success">
                            <th> ID </th>
                            <th> Cantidad de Libros </th>
                            <th> Fecha de Salida </th>
                            <th> Fecha de Entrega </th>
                            <th> Cliente </th>
                            <th> Días Restantes </th>
                            <th> Adeudo </th>
                            <th> Estatus </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrows as $borrow)
                            <tr>
                                <td><a class="btn btn-sm btn-block bg-olive" href="{{ route('borrows.show', $borrow->id) }}">{{ $borrow->id }}</a></td>
                                <td>{{ $borrow->amount_book }}</td>
                                <td>{{ $borrow->getOutDate() }}</td>
                                <td>{{ $borrow->getInDate() }}</td>
                                <td>{{ $borrow->client->name }}</td>
                                <td>{{ $borrow->getDays() }}</td>
                                <td>{{ '$ '.$borrow->getOwed() }}</td>
                                <td class="{{ $borrow->getCondition() }}">{{ $borrow->getCondition() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    @endif
@endsection