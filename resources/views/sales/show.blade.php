@extends('layouts.theme')

@section('title', 'Factura')

@section('content-header')
    <h1><div class="col-md-8"><strong>{{ "Factura : ". $invoice->id }} </strong></div></h1><hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.balancedue')

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt> Fecha : </dt><dd>{{ $invoice->get_date() }}</dd>
                        <dt> Turno : </dt><dd>{{ $invoice->shift }}</dd>
                        <dt> Cliente : </dt><dd>{{ $invoice->client->getInfo() }}</dd>
                        <dt> Usuario : </dt><dd>{{ $invoice->user->getUser() }}</dd>
                        <dt> ---------- </dt><dd> ---------- </dd>
                        <dt> SubTotal : </dt><dd>{{ '$ '.$invoice->subTotal }}</dd>
                        <dt> Total : </dt><dd>{{ '$ '.$invoice->total }}</dd>
                        <dt> Monto Recibido : </dt><dd>{{ '$ '.$invoice->received }}</dd>
                    </dl>
                </div>

                {{-- PRODUCTOS VENDIDOS --}}
                <div class="col-md-6">
                    <div class="box-group" id="accordion">
                        <div class="box-title">Productos Vendidos </div>
                        <div class="panel box box-primary">
                            @foreach($invoice->sales as $sale)
                                <div class="box-header with-border">
                                    <div class="pull-right">
                                        <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $sale->id }}" align="pull-right"><i> ver detalles </i></a></b>
                                    </div>
                                    {{ $sale->type.' : '.$sale->product_id }}
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
                    <a class="btn btn-primary col-md-12" href="{{ route('sales.index') }}"> Aceptar </a>
                </div>
            </div>
        </div>
    </div>
@endsection