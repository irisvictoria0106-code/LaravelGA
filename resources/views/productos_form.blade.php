<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($producto) ? 'Editar' : 'Nuevo' }} Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar" style="background-color: #6b4f3a;">
    <div class="container">
        <span class="navbar-brand text-white">{{ isset($producto) ? 'Editar' : 'Nuevo' }} Producto</span>
        <a href="{{ route('productos.index') }}" class="btn" style="background-color: #b59a7a; color: white;">Volver</a>
        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Salir</a>
    </div>
</nav>
<div class="container mt-4">
    <div class="card">
        <div class="card-header" style="background-color: #6b4f3a; color: white;">
            <h4>{{ isset($producto) ? 'Editar' : 'Registrar' }} Producto</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($producto) ? route('productos.update', $producto->id) : route('productos.store') }}">
                @csrf
                @if(isset($producto)) @method('PUT') @endif
                
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="{{ isset($producto) ? $producto->nombre : '' }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Cantidad</label>
                    <input type="number" name="cantidad" value="{{ isset($producto) ? $producto->cantidad : '' }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Precio</label>
                    <input type="number" step="0.01" name="precio" value="{{ isset($producto) ? $producto->precio : '' }}" class="form-control" required>
                </div>
                <button type="submit" class="btn" style="background-color: #6b4f3a; color: white;">Guardar</button>
                <a href="{{ route('productos.index') }}" class="btn" style="background-color: #b59a7a; color: white;">Cancelar</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>