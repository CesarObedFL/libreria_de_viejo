@extends('layouts.theme')

@section('title', 'Donaciones')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
        td.Recibida { background-color: rgba(0,188,212,0.5); }
        td.Realizada { background-color: rgba(244,67,54,0.5); }
    </style>
@endsection

@section('content-header') 
    <h1>
        <div class="col-md-6">
            <strong>Donaciones Realizadas</strong>
        </div>
        <div class="col-md-2">
            <a class="btn btn-block pull-right" href="{{ route('donors.index') }}">
            <i class="fa fa-institution"></i> INSTITUCIONES </a>
        </div>
        <div class="col-md-2">
            <a class="btn btn-info btn-block pull-right" href="{{ route('donation.receive') }}">
            <i class="fa fa-backward"></i> RECIBIR </a>
        </div>
        <div class="col-md-2">
            <a class="btn btn-danger btn-block pull-right" href="{{ route('donation.donate') }}">
            <i class="fa fa-forward"></i> DONAR </a>
        </div>
    </h1>
    <hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.delete')

    @if($donations->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i> No hay donaciones registradas...
            </div>
        </div>
    
    @else
        <div class="box">
            <div class="box-header">
                <form role="form" action="{{ route('donations.index') }}" method="GET">
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
                    </div> <!-- /. class="box-body" -->
                </form>
            </div> <!-- /. class="box-header" -->
            <div class="box-body">
                <table id="donations_table" class="table table-condensed text-center">
                    <thead>
                        <tr class="success">
                            <th> ID </th>
                            <th> Fecha </th>
                            <th> Cantidad de Libros </th>
                            <th> Clasificación de Libros </th>
                            <th> Donación </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donations as $donation)
                            <tr id="tableRow" value="{{ $donation->type }}">
                                <td><a class="btn btn-sm btn-block bg-olive" href="{{ route('donations.show', $donation->id) }}">{{ $donation->id }}</a></td>
                                <td>{{ $donation->getDate() }}</td>
                                <td>{{ $donation->amount }}</td>
                                <td>{{ $donation->classification->name }}</td>
                                <td class="{{ $donation->type }}">{{ $donation->type }}</td>
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
        });
      });
    </script>
@endsection