@extends('layouts.theme')

@section('title', 'Factura')

@section('content-header')
    <h1><div class="col-md-8"><strong>{{ "Factura : ". $INVOICE->id }} </strong></div></h1><hr>
@endsection

@section('content')

    <div class="col-md-12">
        <div class="box box-solid">
            {{--<div class="box-header with-border">
                <h1 class="box-title"> </h1>
            </div> --}}
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt> Fecha : </dt><dd>{{ $INVOICE->date }}</dd>
                        <dt> Turno : </dt><dd>{{ $INVOICE->turn }}</dd>
                        <dt> Cliente : </dt><dd>{{ $INVOICE->client->getInfo() }}</dd>
                        <dt> Usuario : </dt><dd>{{ $INVOICE->user->getUser() }}</dd>
                        <dt> ---------- </dt><dd> ---------- </dd>
                        <dt> SubTotal : </dt><dd>{{ $INVOICE->subTotal }}</dd>
                        <dt> Total : </dt><dd>{{ $INVOICE->total }}</dd>
                        <dt> Monto Recibido : </dt><dd>{{ $INVOICE->received }}</dd>
                    </dl>
                </div>

                {{-- PRODUCTOS VENDIDOS --}}
                <div class="col-md-6">
                    <div class="box-group" id="accordion">
                        <div class="box-title">Productos Vendidos </div>
                        <div class="panel box box-primary">
                            @foreach($INVOICE->sales as $sale)
                                <div class="box-header with-border">
                                    <div class="pull-right">
                                        <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $sale->id }}" align="pull-right"><i> ver detalles </i></a></b>
                                    </div>
                                    {{ 'Producto: '.$sale->productID }} &nbsp;::&nbsp; 
                                    {{ $sale->type }}
                                </div>
                                <div id="collapse{{ $sale->id }}" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <dl class="dl-horizontal">
                                            <dt>Cantidad:</dt><dd>{{ $sale->amount }}</dd>
                                            <dt>Precio:</dt><dd>{{ '$ '.$sale->price }}</dd>
                                            <dt>Descuento:</dt><dd>{{ $sale->discount.' %' }}</dd>
                                        </dl>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> {{-- PRODUCTOS VENDIDOS --}}
            </div> {{-- BOX BODY --}}
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-12" href="{{ route('sale.index') }}"> Aceptar </a>
                </div>
            </div>
        </div>
        {{--<div class="col-md-13">
            <div class="box box-primary">
                <form role="form" action="{{ route('sale.destroy', $INVOICE->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="box-footer">
                        <a class="btn btn-primary col-md-4" href="{{ route('sale.index') }}"> Aceptar </a>
                        <button type="submit" class="btn btn-danger col-md-4"> Eliminar </button>
                    </div>
                </form>
            </div>
        </div> --}}
    </div>
@endsection