@extends('layouts.theme')

@section('title', 'Libros')

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
        <div class="col-md-8"><strong>Lista de Libros</strong></div>
        <div class="col-md-4">
            <a class="btn btn-success btn-block pull-right" href="{{ route('book.create') }}">
            <i class="fa  fa-pencil-square-o"></i> NUEVO REGISTRO </a>
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
        <table id="booksTable" class="table table-bordered table-striped">
            <thead>
                <tr class="success">
                    <th> ISBN </th>
                    <th> Título </th>
                    <th> Autor </th>
                    <th> Editorial </th>
                    <th> Stock </th>
                </tr>
            </thead>
            <tbody>
                @foreach($BOOKS as $book)
                    <tr>
                        <td><a class="btn btn-sm btn-info bg-olive" href="{{ route('book.show', $book->ID) }}">{{ $book->ISBN }}</a></td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->editorial }}</td>
                        <td>{{ $book->stock }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    @endif
@endsection

