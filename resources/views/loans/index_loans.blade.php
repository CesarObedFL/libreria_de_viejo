@extends('layouts.theme')

@section('title', 'Préstamos')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content-header')
    <h1>
        <div class="col-md-8"><strong>Préstamos Realizados</strong></div>
        <div class="col-md-4">
            <a class="btn btn-success btn-block pull-right" href="{{ route('loan.create') }}">
            <i class="fa  fa-pencil-square-o"></i> REALIZAR PRÉSTAMO </a>
        </div>
    </h1>
    <hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.delete')

    @if($LOANS->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i> No hay préstamos registrados...
            </div>
        </div>
    
    @else
        <div class="box">
            {{--<div class="box-header"></div>--}}
            <div class="box-body">
                <table class="table table-condensed text-center" id="loansTable">
                    <thead>
                        <tr class="success">
                            <th> ID </th>
                            <th> Cantidad de Libros </th>
                            <th> Fecha de Salida </th>
                            <th> Fecha de Devolución </th>
                            <th> Cliente </th>
                            <th> Adeudo </th>
                            <th> Estatus </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($LOANS as $loan)
                            <tr>
                                <td><a class="btn btn-sm btn-block btn-info bg-olive" href="{{ route('loan.show', $loan->id) }}">{{ $loan->id }}</a></td>
                                <td>{{ $loan->amount }}</td>
                                <td>{{ $loan->getOutDate() }}</td>
                                <td>{{ $loan->getInDate() }}</td>
                                <td>{{ $loan->client->name }}</td>
                                <td>{{ '$ '.$loan->getOwed() }}</td>
                                <td class="danger">{{ $loan->status }}</td>
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

@section('scripts')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
      $(function () {
        $('#loansTable').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        })
        //$('#loansTable td:last-child:contains(Activo)').addClass('info');
        $('#loansTable td:last-child:contains(Activo)').attr('class','info');
        $('#loansTable td:last-child:contains(Entregado)').addClass('success');
      });
    </script>
@endsection