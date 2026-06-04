@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header" style="background-color: #8b5e3c; color: white;">
                <h5 class="mb-0">Registrar Compra</h5>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
                <form method="POST" action="{{ route('compras.store') }}" id="formCompra">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <select name="producto_id" class="form-control" required>
                            <option value="">Seleccionar producto</option>
                            @foreach($productos as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nombre }} (Stock actual: {{ $p->stock }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" placeholder="Ingrese la cantidad" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Fecha de compra</label>
                        <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Proveedor</label>
                        <input type="text" name="proveedor" class="form-control" placeholder="Nombre del proveedor" required>
                    </div>
                    
                    <button type="submit" class="btn w-100" style="background-color: #6b4f3a; color: white;">Registrar Compra</button>
                    
                    <button type="reset" class="btn w-100 mt-2" style="background-color: #b59a7a; color: white;" onclick="this.form.reset()">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-7">
        <div class="card">
            <div class="card-header" style="background-color: #6b4f3a; color: white;">
                <h5 class="mb-0">Historial de Compras</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #6b4f3a; color: white;">
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Proveedor</th>
                                <th>Fecha</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($compras as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>{{ $c->producto_nombre }}</td>
                                <td>{{ $c->cantidad }}</td>
                                <td>{{ $c->proveedor ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y') }}</td>
                                <td>${{ number_format($c->total, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay compras registradas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection