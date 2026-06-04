<!DOCTYPE html>
<html>
<head>
    <title>Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Inventario</span>
        <a href="/dashboard" class="btn btn-secondary btn-sm">Volver</a>
        <a href="/logout" class="btn btn-danger btn-sm">Salir</a>
    </div>
</nav>
<div class="container mt-4">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Valor Total</th></tr>
        </thead>
        <tbody>
            @foreach($productos as $p)
            <tr>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->cantidad }}</td>
                <td>${{ $p->precio }}</td>
                <td>${{ $p->cantidad * $p->precio }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>