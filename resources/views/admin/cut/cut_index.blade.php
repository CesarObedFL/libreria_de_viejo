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

    @if(false)
        <div class="col-md-12">
            <div class="alert alert-warning">
                <i class="icon fa fa-warning"></i> No hay donaciones registradas...
            </div>
        </div>
    
    @else
        <div class="box">
            {{--<div class="box-header"></div> --}}
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
                       {{-- @foreach($DONATIONS as $donation)
                            <tr id="tableRow" value="{{ $donation->type }}">
                                <td><a class="btn btn-sm btn-block btn-info bg-olive" href="{{ route('donation.show', $donation->id) }}">{{ $donation->id }}</a></td>
                                <td>{{ $donation->getDate() }}</td>
                                <td>{{ $donation->amount }}</td>
                                <td>{{ $donation->getClass() }}</td>
                                <td>{{ $donation->type }}</td>
                            </tr>
                        @endforeach--}}
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
                        {{--<tr>
                            <td width="10%">=$totalLibrosVendidos?></td>
                            <td width="10%">=$totalPlantasVendidas?></td>
                            <td width="10%">=$ventasRealizadas?></td>
                            <td width="10%">="$".round($recaudadoEnTrueques,2)?></td>
                            <td width="10%">="$".round($recaudadoEnPrestamos,2)?></td>
                            <td width="10%">="$".round($totalEnVentas,2)?></td>
                            <td width="10%">="$".round(($totalEnVentas+$recaudadoEnTrueques),2)?></td>
                            <td width="15%">="$".round(($totalEnVentas+$recaudadoEnTrueques+$recaudadoEnPrestamos),2)?></td>
                            <td width="10%">="$".round((($totalEnVentas+$recaudadoEnTrueques)/10),2)?></td> <!-- COMISIONES -->
                        </tr>--}}
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