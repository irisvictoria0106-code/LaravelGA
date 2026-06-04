@extends('layouts.app')

@section('content')
<style>
    .metric-card {
        border: 1px solid #d4a373;
    }
    .bg-cafe-1 {
        background-color: #6b4f3a;
    }
    .bg-cafe-2 {
        background-color: #8b5e3c;
    }
    .bg-cafe-3 {
        background-color: #5d4037;
    }
    .bg-cafe-4 {
        background-color: #4e342e;
    }
    .border-cafe {
        border-color: #d4a373;
    }
    .text-cafe {
        color: #6b4f3a;
    }
    .progress-circle {
        width: 120px;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
</style>

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card metric-card bg-cafe-1 text-white">
            <div class="card-body">
                <div>
                    <h6>Ventas de hoy</h6>
                    <h2 class="mb-0">${{ number_format(App\Models\Venta::whereDate('fecha', today())->sum('total'), 2) }}</h2>
                    <small>registrado hoy</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card metric-card bg-cafe-2 text-white">
            <div class="card-body">
                <div>
                    <h6>Productos</h6>
                    <h2 class="mb-0">{{ App\Models\Producto::count() }}</h2>
                    <small>en catálogo</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card metric-card bg-cafe-3 text-white">
            <div class="card-body">
                <div>
                    <h6>Compras hoy</h6>
                    <h2 class="mb-0">${{ number_format(App\Models\Compra::whereDate('created_at', today())->sum('total'), 2) }}</h2>
                    <small>invertido hoy</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card metric-card bg-cafe-4 text-white">
            <div class="card-body">
                <div>
                    <h6>Valor inventario</h6>
                    <h2 class="mb-0">${{ number_format(App\Models\Producto::sum(DB::raw('stock * precio_venta')), 2) }}</h2>
                    <small>en existencias</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-5 mb-3">
        <div class="card h-100 border-cafe">
            <div class="card-header bg-white border-cafe">
                <h5 class="mb-0 text-cafe">Estado del inventario</h5>
            </div>
            <div class="card-body text-center">
                @php
                    $total = App\Models\Producto::count();
                    $agotados = App\Models\Producto::where('stock', 0)->count();
                    $bajo = App\Models\Producto::where('stock', '>', 0)
                            ->where(function($q) {
                                $q->where('stock', '<=', 'stock_minimo')
                                  ->orWhere('stock', '<=', 5);
                            })->count();
                    $ok = $total - ($agotados + $bajo);
                    $porcentajeOk = $total > 0 ? round($ok / $total * 100) : 0;
                @endphp
                
                <div class="position-relative d-inline-block mb-3">
                    <div class="progress-circle" style="background: conic-gradient(#6b4f3a 0deg {{ $porcentajeOk * 3.6 }}deg, #f5e6d3 {{ $porcentajeOk * 3.6 }}deg 360deg);">
                        <div style="background: white; width: 90px; height: 90px; display: flex; align-items: center; justify-content: center; flex-direction: column; border: 1px solid #d4a373;">
                            <span style="font-size: 24px; font-weight: bold; color: #6b4f3a;">{{ $porcentajeOk }}%</span>
                            <small style="color: #6b4f3a;">saludable</small>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-4">
                        <div class="border p-2 border-cafe">
                            <strong class="text-cafe">{{ $ok }}</strong>
                            <small class="d-block text-muted">Normal</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="border p-2 border-cafe">
                            <strong class="text-cafe">{{ $bajo }}</strong>
                            <small class="d-block text-muted">Bajo stock</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="border p-2 border-cafe">
                            <strong class="text-cafe">{{ $agotados }}</strong>
                            <small class="d-block text-muted">Agotados</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-7 mb-3">
        <div class="card h-100 border-cafe" style="background-color: #6b4f3a;">
            <div class="card-body text-center text-white">
                @php
                    $productoM = DB::table('venta_detalles')
                        ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
                        ->select('productos.nombre', DB::raw('SUM(venta_detalles.cantidad) as total'))
                        ->groupBy('productos.id', 'productos.nombre')
                        ->orderBy('total', 'desc')
                        ->first();
                @endphp
                
                @if($productoM)
                    <h5>Producto más vendido</h5>
                    <h3>{{ $productoM->nombre }}</h3>
                    <p>{{ $productoM->total }} unidades vendidas</p>
                @else
                    <h5>No hay ventas registradas</h5>
                    <p>Registra una venta para ver estadísticas</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card border-cafe">
            <div class="card-header bg-white border-cafe">
                <h5 class="mb-0 text-cafe">Últimas ventas</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr>
                            <th class="text-cafe">Folio</th>
                            <th class="text-cafe">Total</th>
                            <th class="text-cafe">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(App\Models\Venta::latest()->take(5)->get() as $v)
                        <tr>
                            <td>#{{ $v->folio }}</td>
                            <td>${{ number_format($v->total, 2) }}</td>
                            <td class="text-muted">{{ $v->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <td><td colspan="3" class="text-center py-3 text-muted">No hay ventas recientes</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card border-cafe">
            <div class="card-header bg-white border-cafe">
                <h5 class="mb-0 text-cafe">Alertas del sistema</h5>
            </div>
            <div class="card-body">
                @php
                    $alertas = [];
                    if($bajo > 0) $alertas[] = "$bajo productos con stock bajo";
                    if($agotados > 0) $alertas[] = "$agotados productos agotados";
                    if(empty($alertas)) $alertas[] = "Todo en orden";
                @endphp
                @foreach($alertas as $alerta)
                    <p class="mb-2">{{ $alerta }}</p>
                @endforeach
                @if(isset($productoM) && $productoM)
                    <hr>
                    <p class="mb-0">"{{ $productoM->nombre }}" es el más vendido</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection