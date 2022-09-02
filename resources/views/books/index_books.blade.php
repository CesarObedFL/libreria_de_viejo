@extends('layouts.theme')

@section('title', 'Libros')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

    <style>
        td.empty { background-color: rgba(244,67,54,0.5); }
        td.full { background-color: rgba(76,175,80,0.5); }
    </style>

@endsection

@section('scripts')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
      $(function () {
        $('#books_table').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
          'language': {
                    "emptyTable":           "No hay registros disponibles en la tabla...",
                    "info":                 "Mostrando del _START_ al _END_ de _TOTAL_ ",
                    "infoEmpty":            "Mostrando 0 registros de un total de 0.",
                    "infoFiltered":         "(filtrados de un total de _MAX_ registros)",
                    "infoPostFix":          "registros",
                    "lengthMenu":           "Mostrar _MENU_ registros",
                    "loadingRecords":       "Cargando...",
                    "processing":           "Procesando...",
                    "search":               "Buscar:",
                    "searchPlaceholder":    "Libro a buscar",
                    "zeroRecords":          "No se han encontrado coincidencias.",
                    "paginate": {
                        "first":            "Primera",
                        "last":             "Última",
                        "next":             "Siguiente",
                        "previous":         "Anterior"
                    },
                    "aria": {
                        "sortAscending":    "Ordenación ascendente",
                        "sortDescending":   "Ordenación descendente"
                    }
                },
        });
        //$('#booksTable td:last-child:contains(0)').addClass('bg-orange- color-palette');
      });
    </script>
@endsection

@section('content-header')
    <h1>
        <div class="col-md-8"><strong>Lista de Libros</strong></div>
        <div class="col-md-4">
            <a class="btn btn-success btn-block pull-right" href="{{ route('books.create') }}">
            <i class="fa fa-pencil-square-o"></i> NUEVO REGISTRO </a>
        </div>
    </h1>
    <hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.delete')

    @if($BOOKS->isEmpty())
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i> No hay libros registrados...
            </div>
        </div>
    
    @else
        <table id="books_table" class="table table-bordered table-striped">
            <thead>
                <tr class="success">
                    <th> ID </th>
                    <th> ISBN </th>
                    <th> Título </th>
                    <th> Autor </th>
                    <th> Editorial </th>
                    <th> Estante </th>
                    <th> Stock </th>
                </tr>
            </thead>
            <tbody>
                @foreach($BOOKS as $book)
                    <tr>
                        <td><a class="btn btn-sm btn-block bg-olive" href="{{ route('books.show', $book->id) }}">{{ $book->id }}</a></td>
                        <td>{{ $book->ISBN }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->editorial }}</td>
                        <td>{{ $book->getLocation() }}</td>
                        <td class="{{ $book->getStockState() }}">{{ $book->stock }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    @endif
@endsection

