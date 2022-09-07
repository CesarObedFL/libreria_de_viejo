@extends('layouts.theme')

@section('title', 'Prestámo')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. del Préstamo #{{ $borrow->id }}</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.balancedue')

    <div class="col-md-12">
        <div class="box box-solid"> 
            <div class="box-header with-border">
                <h1 class="box-title"> {{ 'Cliente: '.$borrow->client->getInfo() }} </h1>
            </div> <!-- /. class="box-header with-border" -->
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Fecha de Préstamo:</dt><dd>{{ $borrow->getOutDate() }}</dd>
                        <dt>Fecha de Entrega:</dt><dd>{{ $borrow->getInDate() }}</dd>
                        <dt>Estatus:</dt><dd>{{ $borrow->status }}</dd>
                        <dt>Días Restantes:</dt><dd>{{ $borrow->getDays() }}</dd>
                        <dt>Adeudo:</dt><dd>{{ '$ '.$borrow->getOwed() }}</dd>
                        <dt>Pago:</dt><dd>{{ '$ '.$borrow->amount }}</dd>
                        <dt>----------</dt><dd>----------</dd>
                        <dt>Usuario:</dt><dd>{{ $borrow->user->getUser() }}</dd>
                    </dl>
                </div> <!-- /. class="col-md-6" -->
                
                <div class="col-md-6"> {{-- LIBROS PRESTADOS --}}
                    <div class="box-group" id="accordion">
                        <div class="box-title">
                            {{ "Libros Prestados: ".$borrow->amount_book }}
                        </div>
                        <div class="panel box box-primary">
                            @foreach($borrow->borrowed_books as $borrowed_book)
                                <div class="box-header with-border">
                                    <div class="pull-right">
                                        <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $borrowed_book->id }}" align="pull-right"> <i>ver detalles</i> </a></b>
                                    </div>
                                    {{ $borrowed_book->book->title }}
                                </div>
                                <div id="collapse{{ $borrowed_book->id }}" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <dl class="dl-horizontal">
                                            <dt>Autor:</dt><dd>{{ $borrowed_book->book->author }}</dd>
                                            <dt>Editorial:</dt><dd>{{ $borrowed_book->book->editorial }}</dd>
                                            <dt>Cantidad:</dt><dd>{{ $borrowed_book->amount }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            @endforeach
                        </div> <!-- /. class="panel box box-primary" -->
                    </div> <!-- /. class="box-group" -->
                </div> {{-- LIBROS PRESTADOS --}}
            </div> <!-- /. class="box-body" -->
        </div> <!-- /.class="box box-solid" -->
        
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-6" href="{{ route('borrows.index') }}"> Aceptar </a>
                    @if(!$borrow->getStatus())
                    <a class="btn btn-success col-md-6" href="{{ route('borrows.edit', $borrow->id) }}"><i class="fa fa-mail-reply"></i><span> Devolución</span></a>
                    @endif
                </div> <!-- /. class="box-footer" -->
            </div> <!-- /. class="box box-primary" -->
        </div> <!-- /. class="col-md-12" -->

    </div> <!-- /. class="col-md-12" -->
@endsection