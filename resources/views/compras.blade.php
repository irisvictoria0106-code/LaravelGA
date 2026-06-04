<!DOCTYPE html>
<html>
<head>
    <title>Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Compras</span>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Volver</a>
        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Salir</a>
    </div>
</nav>
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header bg-info text-white">Nueva Compra</div>
        <div class="card-body">
            <form method="POST" action="{{ route('compras.store') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <select name="producto_id" class="form-control" required>
                            <option value="">Seleccionar Producto</option>
                            @foreach($productos as $p)
                            <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" required>
                    </div>
                    <div class="col">
                        <button class="btn btn-info">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr><th>ID</th><th>Producto</th><th>Cantidad</th><th>Total</th><th>Fecha</th></tr>
        </thead>
        <tbody>
            @foreach($compras as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->producto_nombre }}</td>
                <td>{{ $c->cantidad }}</td>
                <td>${{ $c->total }}</td>
                <td>{{ $c->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>