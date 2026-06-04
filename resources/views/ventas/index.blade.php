@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header" style="background-color: #6b4f3a; color: white;">
                <h5 class="mb-0">Registrar Venta</h5>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
                <form method="POST" action="{{ route('ventas.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <select name="producto_id" class="form-control" id="productoSelect" required>
                            <option value="">Seleccionar producto</option>
                            @foreach($productos as $p)
                            <option value="{{ $p->id }}" data-precio="{{ $p->precio_venta }}">
                                {{ $p->nombre }} (Stock: {{ $p->stock }}) - ${{ number_format($p->precio_venta, 2) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Total de venta</label>
                        <input type="text" id="totalVenta" class="form-control" readonly>
                    </div>
                    
                    <button type="submit" class="btn w-100" style="background-color: #6b4f3a; color: white;">Registrar Venta</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-7">
        <div class="card">
            <div class="card-header" style="background-color: #8b5e3c; color: white;">
                <h5 class="mb-0">Historial de Ventas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #6b4f3a; color: white;">
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ventas as $v)
                            <tr>
                                <td>{{ $v->id }}</td>
                                <td>{{ $v->producto_nombre }}</td>
                                <td>{{ $v->cantidad }}</td>
                                <td>${{ number_format($v->total, 2) }}</td>
                                <td>{{ $v->created_at }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay ventas registradas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const productoSelect = document.getElementById('productoSelect');
    const cantidadInput = document.getElementById('cantidad');
    const totalVenta = document.getElementById('totalVenta');
    
    function calcularTotal() {
        const precio = productoSelect.options[productoSelect.selectedIndex]?.dataset.precio || 0;
        const cantidad = cantidadInput.value || 0;
        totalVenta.value = '$' + (precio * cantidad).toFixed(2);
    }
    
    productoSelect.addEventListener('change', calcularTotal);
    cantidadInput.addEventListener('keyup', calcularTotal);
</script>
@endsection