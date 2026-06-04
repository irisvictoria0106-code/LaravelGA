@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Análisis de Ventas por Temporada</h3>
    <a href="{{ route('inventario.index') }}" class="btn btn-secondary">Volver</a>
</div>

@if($totalVentas == 0)
<div class="alert alert-warning">No hay ventas registradas. Registra una venta para ver el análisis.</div>
@else
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header">Ventas por mes</div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead style="background-color: #6b4f3a; color: white;"><tr><th>Mes</th><th>Cantidad</th><th>Total</th><th>%</th></tr></thead>
                    <tbody>
                        @foreach($ventasPorMes as $v)
                        <tr><td>{{ $meses[$v->mes - 1] }}</td><td>{{ $v->cantidad }}</td><td>${{ number_format($v->total, 2) }}</td><td>{{ round(($v->total / $ventasPorMes->sum('total')) * 100, 1) }}%</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header">Material más vendido</div>
            <div class="card-body">
                @php
                    $materialMasVendido = DB::table('venta_detalles')
                        ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
                        ->select('productos.tipo_material', DB::raw('SUM(venta_detalles.cantidad) as total'))
                        ->groupBy('productos.tipo_material')
                        ->orderBy('total', 'desc')
                        ->first();
                @endphp
                @if($materialMasVendido)
                    <p><strong>{{ $materialMasVendido->tipo_material }}</strong> con {{ $materialMasVendido->total }} unidades vendidas</p>
                    <p>Recomendación: priorizar compras de este material.</p>
                @else
                    <p>Sin datos suficientes.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card mt-2">
    <div class="card-header">Recomendaciones</div>
    <div class="card-body">
        @php
            $mejorMes = $ventasPorMes->sortByDesc('total')->first();
            $mejorMesNombre = $mejorMes ? $meses[$mejorMes->mes - 1] : 'N/A';
        @endphp
        <p>Mejor temporada de ventas: <strong>{{ $mejorMesNombre }}</strong>. Aumentar inventario antes de ese mes.</p>
        @if($materialMasVendido)
        <p>Material con mayor demanda: <strong>{{ $materialMasVendido->tipo_material }}</strong>. Mantener stock alto.</p>
        @endif
    </div>
</div>
@endif
@endsection