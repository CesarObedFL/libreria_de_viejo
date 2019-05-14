@extends('layouts.theme')

@section('title', 'Prestámo')

@section('content-header')
    <h1><div class="col-md-8"><strong>Info. del Préstamo #{{ $BORROW->id }}</strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.balancedue')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title"> {{ 'Cliente: '.$BORROW->client->getInfo() }} </h1>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Fecha de Préstamo:</dt><dd>{{ $BORROW->getOutDate() }}</dd>
                        <dt>Fecha de Entrega:</dt><dd>{{ $BORROW->getInDate() }}</dd>
                        <dt>Estatus:</dt><dd>{{ $BORROW->status }}</dd>
                        <dt>Adeudo:</dt><dd>{{ '$ '.$BORROW->getOwed() }}</dd>
                        <dt>Pago:</dt><dd>{{ '$ '.$BORROW->amount }}</dd>
                        <dt>----------</dt><dd>----------</dd>
                        <dt>Usuario:</dt><dd>{{ $BORROW->user->getUser() }}</dd>
                    </dl>
                </div>
                {{-- LIBROS PRESTADOS --}}
                <div class="col-md-6">
                    <div class="box-group" id="accordion">
                        <div class="box-title">{{ "Libros Prestados: ".$BORROW->amountbooks }}</div>
                        <div class="panel box box-primary">
                            @foreach($BORROW->borrowedbooks as $bBook)
                                <div class="box-header with-border">
                                    <div class="pull-right">
                                        <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $bBook->id }}" align="pull-right"> <i>ver detalles</i> </a></b>
                                    </div>
                                    {{ $bBook->book->title }}
                                </div>
                                <div id="collapse{{ $bBook->id }}" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <dl class="dl-horizontal">
                                            <dt>Autor:</dt><dd>{{ $bBook->book->author }}</dd>
                                            <dt>Editorial:</dt><dd>{{ $bBook->book->editorial }}</dd>
                                            <dt>Cantidad:</dt><dd>{{ $bBook->amount }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> {{-- LIBROS PRESTADOS --}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-6" href="{{ route('borrow.index') }}"> Aceptar </a>
                    @if(!$BORROW->getStatus())
                    <a class="btn btn-success col-md-6" href="{{ route('borrow.edit',$BORROW->id) }}"><i class="fa fa-mail-reply"></i><span> Devolución</span></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection