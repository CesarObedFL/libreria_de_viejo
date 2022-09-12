@extends('layouts.theme')

@section('title', 'Instituciones / Contactos')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content-header')
    <h1>
        <div class="col-md-6"><strong>Instituciones y Contactos Registrados</strong></div>
        <div class="col-md-2">
            <a class="btn btn-block pull-right" href="{{ route('donations.index') }}">
            <i class="fa fa-gift"></i> DONACIONES </a>
        </div>
        <div class="col-md-4">
            <a class="btn btn-success btn-block pull-right" href="{{ route('donors.create') }}">
            <i class="fa fa-pencil-square-o"></i> NUEVA INSTITUCIÓN O CONTACTO </a>
        </div>
    </h1>
    <hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.delete')
    @include('partials.edit')

    @if($donors->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i> No hay instituciones o contactos registrados...
            </div>
        </div>
    
    @else
        <div class="box">
            <div class="box-body">
                <table id="donations_table" class="table table-bordered table-striped">
                    <thead>
                        <tr class="success">
                            <th> ID </th>
                            <th> Institución </th>
                            <th> Contacto </th>
                            <th> Correo </th>
                            <th> Telefono </th>
                            <th> Dirección </th>
                            <th> Actividad </th>
                            <!-- <th>  </th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donors as $donor)
                            <tr>
                                <td><a class="btn btn-block btn-sm bg-olive" href="{{ route('donors.edit', $donor->id) }}">{{ $donor->id }}</a></td> 
                                <td>{{ $donor->institution }}</td>
                                <td>{{ $donor->contact }}</td>
                                <td>{{ $donor->email }}</td>
                                <td>{{ $donor->phone }}</td>
                                <td>{{ $donor->address }}</td>
                                <td>{{ $donor->commercial_business }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> <!-- /. id="donations_table" -->
            </div> <!-- /. class="box-body" -->
        </div> <!-- /. class="box" -->
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
      $(function () {
        $('#donations_table').DataTable({
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