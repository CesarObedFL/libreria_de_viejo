@extends('layouts.theme')

@section('title', 'Plantas')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
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

@section('content-header')
    <h1>
        <div class="col-md-8"><strong>Lista de Plantas</strong></div>
        <div class="col-md-4">
            <a class="btn btn-success btn-block pull-right" href="{{ route('plant.create') }}">
            <i class="fa  fa-pencil-square-o"></i> NUEVO REGISTRO </a>
        </div>
    </h1>
    <hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.delete')

    @if($PLANTS->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i> No hay plantas registradas...
            </div>
        </div>
    
    @else
        <table id="booksTable" class="table table-condensed">
            <thead>
                <tr class="success">
                    <th> ID </th>
                    <th> Planta </th>
                    <th> Stock </th>
                </tr>
            </thead>
            <tbody>
                @foreach($PLANTS as $plant)
                    <tr>
                        <td><a class="btn btn-sm btn-block bg-olive" href="{{ route('plant.show', $plant->id) }}">{{ $plant->id }}</a></td>
                        <td>{{ $plant->name }}</td>
                        <td>{{ $plant->stock }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    @endif
@endsection

