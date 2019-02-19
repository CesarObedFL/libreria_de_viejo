@extends('layouts.theme')

@section('title', 'Libros')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content-header')
    <h1>
        <div class="col-md-8"><strong>Trueques Realizados</strong></div>
        <div class="col-md-4">
            <a class="btn btn-success btn-block pull-right" href="{{ route('bartering.create') }}">
            <i class="fa  fa-pencil-square-o"></i> REALIZAR TRUEQUE </a>
        </div>
    </h1>
    <hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.delete')

    @if($BARTERINGS->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i> No hay trueques registrados...
            </div>
        </div>
    
    @else
        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
                <table id="booksTable" class="table table-bordered table-striped">
                    <thead>
                        <tr class="success">
                            <th> ID </th>
                            <th> Fecha </th>
                            <th> Usuario </th>
                            <th> Cantidad Entrante </th>
                            <th> Cantidad Salida </th>
                            <th> Monto </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($BARTERINGS as $bartering)
                            <tr>
                                <td><a class="btn btn-sm btn-info bg-olive" href="{{ route('bartering.show', $bartering->ID) }}">{{ $bartering->ID }}</a></td>
                                <td>{{ $bartering->date }}</td>
                                <td>{{ $bartering->userID }}</td>
                                <td>{{ $bartering->in }}</td>
                                <td>{{ $bartering->out }}</td>
                                <td>{{ $bartering->amounttopay }}</td>
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
        $('#booksTable').DataTable({
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