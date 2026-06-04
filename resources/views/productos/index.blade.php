@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Productos</h3>
    <a href="{{ route('productos.create') }}" class="btn btn-primary">Nuevo Producto</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead style="background-color: #6b4f3a; color: white;">
                <tr><th>Código</th><th>Nombre</th><th>Stock</th><th>Precio</th><th>Material</th><th>Estado</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                @forelse($productos as $p)
                <tr class="@if($p->stock <= $p->stock_minimo) stock-bajo @endif">
                    <td>{{ $p->codigo }}</td><td>{{ $p->nombre }}</td><td>{{ $p->stock }}</td>
                    <td>${{ number_format($p->precio_venta, 2) }}</td><td>{{ $p->tipo_material }}</td>
                    <td><span class="badge bg-{{ $p->estado == 'activo' ? 'success' : 'secondary' }}">{{ $p->estado }}</span></td>
                    <td>
                        <a href="{{ route('productos.edit', $p->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('productos.destroy', $p->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center">No hay productos</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $productos->links() }}</div>
</div>
@endsection