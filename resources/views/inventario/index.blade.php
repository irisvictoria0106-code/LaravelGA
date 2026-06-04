@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Inventario</h2>
    <div>
        <a href="{{ route('inventario.analisis') }}" class="btn" style="background-color: #8b5e3c; color: white;">Análisis de Ventas</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card" style="background-color: #6b4f3a; color: white;">
            <div class="card-body">
                <h5>Total de productos</h5>
                <h2>{{ $productos->total() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card" style="background-color: #8b5e3c; color: white;">
            <div class="card-body">
                <h5>Productos disponibles</h5>
                <h2>{{ App\Models\Producto::where('stock', '>', 0)->count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card" style="background-color: #c36053; color: white;">
            <div class="card-body">
                <h5>Productos agotados</h5>
                <h2>{{ App\Models\Producto::where('stock', 0)->count() }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('inventario.index') }}" class="row g-3">
            <div class="col-md-10">
                <label class="form-label">Buscar producto</label>
                <input type="text" name="buscar" class="form-control" placeholder="Nombre del producto" value="{{ request('buscar') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn w-100" style="background-color: #6b4f3a; color: white;">Buscar</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead style="background-color: #6b4f3a; color: white;">
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Stock actual</th>
                        <th>Stock mínimo</th>
                        <th>Precio venta</th>
                        <th>Valor total</th>
                        <th>Estado stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $p)
                    <tr class="@if($p->stock <= $p->stock_minimo && $p->stock > 0) stock-bajo @elseif($p->stock == 0) stock-agotado @endif">
                        <td>{{ $p->codigo }}</td>
                        <td>{{ $p->nombre }}</td>
                        <td>{{ $p->categoria }}</td>
                        <td>{{ $p->stock }}</td>
                        <td>{{ $p->stock_minimo }}</td>
                        <td>${{ number_format($p->precio_venta, 2) }}</td>
                        <td>${{ number_format($p->stock * $p->precio_venta, 2) }}</td>
                        <td>
                            @if($p->stock == 0)
                                <span class="badge" style="background-color: #ee5252; color: white;">Agotado</span>
                            @elseif($p->stock <= $p->stock_minimo)
                                <span class="badge" style="background-color: #ffd586; color: #5d3a1a;">Stock bajo</span>
                            @else
                                <span class="badge" style="background-color: #9ada88; color: #4e342e;">Disponible</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay productos registrados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $productos->links() }}
        </div>
    </div>
</div>

<style>
    .stock-bajo {
        background-color: #fff3cd !important;
    }
    .stock-agotado {
        background-color: #f8d7da !important;
    }
</style>
@endsection