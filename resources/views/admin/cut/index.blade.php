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

    @if(!$box_cutting)
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
                            <label>Periodo: {{ $start_date .' / '.$end_date }}</label>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="start_date"> Fecha Inicial: </label>
                            <input type="date" name="start_date" id="start_date">
                            <label for="end_date"> Fecha Final: </label>
                            <input type="date" name="end_date" id="end_date">
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
                       @foreach($box_cutting as $data)
                            <tr id="tableRow" value="">
                                <td>{{ $data->seller }}</a></td>
                                <td>{{ $data->sold_books }}</td>
                                <td>{{ $data->sold_plants }}</td>
                                <td>{{ $data->sales_amount }}</td>
                                <td>{{ $data->start_date.'   '.$data->end_date }}</td>
                                <td>{{ '$ '.round($data->amount, 2) }}</td>
                                <td>{{ '$ '.round($data->swaps_amount, 2) }}</td>
                                <td>{{ '$ '.round($data->comission, 2) }}</td>
                                <td>{{ '$ '.round($data->paid_amount, 2) }}</td>
                                <td>
                                    <a class="btn btn-sm btn-block bg-olive" href="{{ route('admin.edit', $data->user_id) }}">{{ '$ '.round($data->owe,2) }}
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
                            <td width="10%">{{ $totals['sold_books'] }}</td>
                            <td width="10%">{{ $totals['sold_plants'] }}</td>
                            <td width="10%">{{ $totals['sales_total'] }}</td>
                            <td width="10%">{{ '$ '.$totals['swaps_total'] }}</td>
                            <td width="10%">{{ '$ '.$totals['borrows_total'] }}</td>
                            <td width="10%">{{ '$ '.$totals['total'] }}</td>
                            <td width="10%">{{ '$ '.$totals['subtotal'] }}</td>
                            <td width="15%">{{ '$ '.$totals['ttotal'] }}</td>
                            <td width="10%">{{ '$ '.$totals['comissions'] }}</td> <!-- COMISIONES -->
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