@extends('layouts.theme')

@section('title', 'Corte de Caja')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content-header')
    <h1>
        <div class="col-md-6"><strong>Corte de Caja</strong></div>
    </h1>
    <hr>
@endsection

@section('content')

    @include('partials.success')
    @include('partials.delete')

    @if(!$DATA)
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i> No hay datos registrados...
            </div>
        </div>
    
    @else
        <div class="box">
            <div class="box-header">
                <form role="form" action="{{ route('admin.cut') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-md-4">
                            <label>Periodo: {{ $initDate .' / '.$endDate }}</label>
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
                <table id="salesTable" class="table table-condensed text-center">
                    <thead>
                        <tr class="bg-olive">
                            <th rowspan="2" style="width:20%">Vendedor</th>
                            <th colspan="7">Desglose de Ventas</th>
                            <th colspan="2">Desglose de Pagos</th>
                        </tr>
                        <tr class="success">
                            <th>Libros Vendidos</th>
                            <th>Plantas Vendidas</th>
                            <th>Ventas Realizadas</th>
                            <th>Periodo</th>
                            <th>Monto Vendido</th>
                            <th>Monto en Trueques</th>
                            <th>Comisión(%10)</th>
                            
                            <th>Monto Pagado</th>
                            <th>Adeudo</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($DATA as $data)
                            <tr id="tableRow" value="">
                                <td>{{ $data->Vendedor }}</a></td>
                                <td>{{ $data->librosVendidos }}</td>
                                <td>{{ $data->plantasVendidas }}</td>
                                <td>{{ $data->CantidadVentas }}</td>
                                <td>{{ $data->FechaInicial.'   '.$data->FechaFinal }}</td>
                                <td>{{ '$ '.round($data->Monto,2) }}</td>
                                <td>{{ '$ '.round($data->montoDeTrueques,2) }}</td>
                                <td>{{ '$ '.round($data->Comision,2) }}</td>
                                <td>{{ '$ '.round($data->montoPagado,2) }}</td>
                                <td>
                                    <a class="btn btn-sm btn-block bg-olive" href="{{ route('admin.edit', $data->userID) }}">{{ '$ '.round($data->adeudo,2) }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>

                <hr><hr>
                <table id="totalTable" class="table table-condensed text-center">
                    <thead>
                        <tr class="info">
                            <td>Total de Libros Vendidos</td>
                            <td>Total de Plantas Vendidas</td>
                            <td>Total de Ventas Realizadas</td>
                            <td>Recaudado en Trueques</td>
                            <td>Recaudado en Préstamos</td>
                            <td>Total en Ventas</td>
                            <td>SubTotal (Ventas+Trueques)</td>
                            <td>Total (SubTotal+Préstamos)</td>
                            <td>Total en Comisiones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="10%">{{ $TOTALS['saledBooks'] }}</td>
                            <td width="10%">{{ $TOTALS['saledPlants'] }}</td>
                            <td width="10%">{{ $TOTALS['totalSales'] }}</td>
                            <td width="10%">{{ '$ '.$TOTALS['swapsTotal'] }}</td>
                            <td width="10%">{{ '$ '.$TOTALS['borrowsTotal'] }}</td>
                            <td width="10%">{{ '$ '.$TOTALS['total'] }}</td>
                            <td width="10%">{{ '$ '.$TOTALS['subtotal'] }}</td>
                            <td width="15%">{{ '$ '.$TOTALS['ttotal'] }}</td>
                            <td width="10%">{{ '$ '.$TOTALS['comissions'] }}</td> <!-- COMISIONES -->
                        </tr>
                    </tbody>
                </table>
            </div> {{-- /BODY --}}
            <div class="box-footer"> </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script>
      $(function () {
        $('#salesTable').DataTable({
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