@extends('layouts.theme')

@section('title', 'Trueques')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

    <style>
        td.Incompleto { background-color: rgba(244,67,54,0.5); }
        td.Completo { background-color: rgba(76,175,80,0.5); }
    </style>
@endsection

@section('content-header')
    <h1>
        <div class="col-md-8"><strong>Trueques Realizados</strong></div>
        <div class="col-md-4">
            <a class="btn btn-success btn-block pull-right" href="{{ route('swap.create') }}">
            <i class="fa  fa-pencil-square-o"></i> REALIZAR TRUEQUE </a>
        </div>
    </h1>
    <hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.delete')

    @if($SWAPS->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i> No hay trueques registrados...
            </div>
        </div>
        <center><a class="btn btn-sm btn-success" href="{{ route('swap.index') }}">Aceptar</a></center>
    @else
        <div class="box">
            <div class="box-header">
                <form role="form" action="{{ route('swap.index') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-md-4">
                            <label>Periodo: {{ date("d-m-Y",strtotime($initDate)) .' / '.date("d-m-Y",strtotime($endDate)) }}</label>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="initDate"> Fecha Inicial: </label>
                            <input type="date" name="initDate" id="initDate">
                            <label for="endDate"> Fecha Final: </label>
                            <input type="date" name="endDate" id="endDate">
                            <button type="submit" class="btn btn-primary btn-sm"> Buscar </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-body">
                <table id="booksTable" class="table table-bordered table-striped">
                    <thead>
                        <tr class="success">
                            <th> ID </th>
                            <th> Fecha </th>
                            <th> Usuario </th>
                            <th> Cantidad Entrante </th>
                            <th> Cantidad Saliente </th>
                            <th> Monto </th>
                            <th> Registro </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($SWAPS as $swap)
                            <tr>
                                <td><a class="btn btn-sm btn-block bg-olive" href="{{ route('swap.show', $swap->id) }}">{{ $swap->id }}</a></td>
                                <td>{{ $swap->getDate() }}</td>
                                <td>{{ $swap->user->name }}</td>
                                <td>{{ $swap->incoming }}</td>
                                <td>{{ $swap->outcoming }}</td>
                                <td>{{ '$ '.$swap->amounttopay }}</td>
                                <td class="{{ $swap->isComplete() }}">{{ $swap->isComplete() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
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