@extends('layouts.theme')

@section('title', 'Factura')

@section('content-header')
    <h1>
        <div class="col-md-8">
            <strong>{{ "Factura : ". $invoice->id }} </strong>
        </div>
    </h1>
    <hr>
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
                        <dt> SubTotal : </dt><dd>{{ '$ '.$invoice->subtotal }}</dd>
                        <dt> Total : </dt><dd>{{ '$ '.$invoice->total }}</dd>
                        <dt> Monto Recibido : </dt><dd>{{ '$ '.$invoice->received }}</dd>
                    </dl>
                </div> <!-- /. class="col-md-6" -->
                
                <div class="col-md-6"> {{-- PRODUCTOS VENDIDOS --}}
                    <div class="box-group" id="accordion">
                        <div class="box-title">
                            Productos Vendidos 
                        </div>
                        <div class="panel box box-primary">
                            @foreach($invoice->sales as $sale)
                                <div class="box-header with-border">
                                    <div class="pull-right">
                                        <b><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $sale->id }}" align="pull-right"><i> ver detalles </i></a></b>
                                    </div>
                                    {{ $sale->type.' : '.$sale->soldProduct() }}
                                </div> <!-- /. class="box-header with-border" -->
                                <div id="collapse{{ $sale->id }}" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <dl class="dl-horizontal">
                                            <dt>Cantidad:</dt><dd>{{ $sale->amount }}</dd>
                                            <dt>Precio:</dt><dd>{{ '$ '.$sale->price }}</dd>
                                            <dt>Descuento:</dt><dd>{{ $sale->discount.' %' }}</dd>
                                        </dl>
                                    </div>
                                </div> <!-- /.  class="panel-collapse collapse" -->
                            @endforeach
                        </div> <!-- /. class="panel box box-primary" -->
                    </div> <!-- /. class="box-group" -->
                </div> {{-- PRODUCTOS VENDIDOS --}}
            </div> <!-- /. class="box-body" -->
        </div> <!-- /. class="box box-solid" -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-footer">
                    <a class="btn btn-primary col-md-12" href="{{ route('sales.index') }}"> Aceptar </a>
                </div>
            </div> <!-- /. class="box box-primary" -->
        </div> <!-- /. class="col-md-12" -->
    </div> <!-- /. class="col-md-12" -->
@endsection