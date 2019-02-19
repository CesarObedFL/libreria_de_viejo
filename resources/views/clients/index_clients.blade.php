@extends('layouts.theme')

@section('title', 'Clientes')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
      $(function () {
        $('#clientsTable').DataTable({
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
        <div class="col-md-8"><strong>Lista de Clientes</strong></div>
        <div class="col-md-4">
            <a class="btn btn-success btn-block pull-right" href="{{ route('client.create') }}">
            <i class="fa  fa-pencil-square-o"></i> NUEVO REGISTRO </a>
        </div>
    </h1>
    <hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.delete')

    @if($CLIENTS->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i> No hay clientes registrados...
            </div>
        </div>
    
    @else
        <table id="clientsTable" class="table table-bordered table-striped">
            <thead>
                <tr class="success">
                    <th> ID </th>
                    <th> Nombre </th>
                    <th> Tipo </th>
                </tr>
            </thead>
            <tbody>
                @foreach($CLIENTS as $client)
                    <tr>
                        <td><a class="btn btn-sm btn-info bg-olive" href="{{ route('client.show', $client->id) }}">{{ $client->id }}</a></td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->type }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    @endif
@endsection
