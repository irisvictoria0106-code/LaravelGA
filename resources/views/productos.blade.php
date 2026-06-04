<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #faf7f2;
        }
        table tbody tr td {
            background-color: white;
            color: #4e342e;
        }
        .btn-cafe {
            background-color: #6b4f3a;
            color: white;
        }
        .btn-cafe:hover {
            background-color: #8b5e3c;
            color: white;
        }
        .btn-cafe-claro {
            background-color: #b59a7a;
            color: white;
        }
        .btn-editar {
            background-color: #e6c280;
            color: #5d3a1a;
        }
        .btn-editar:hover {
            background-color: #d4a373;
            color: #3a2a1a;
        }
    </style>
</head>
<body>
<nav class="navbar" style="background-color: #6b4f3a;">
    <div class="container">
        <span class="navbar-brand text-white">Productos</span>
        <a href="{{ route('dashboard') }}" class="btn" style="background-color: #b59a7a; color: white;">Volver</a>
        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Salir</a>
    </div>
</nav>
<div class="container mt-4">
    <a href="{{ route('productos.create') }}" class="btn mb-3" style="background-color: #6b4f3a; color: white;">Nuevo Producto</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table table-bordered">
        <thead style="background-color: #6b4f3a; color: white;">
            <tr><th>ID</th><th>Nombre</th><th>Cantidad</th><th>Precio</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            @foreach($productos as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->cantidad }}</td>
                <td>${{ number_format($p->precio, 2) }}</td>
                <td>
                    <a href="{{ route('productos.edit', $p->id) }}" class="btn btn-sm" style="background-color: #e6c280; color: #5d3a1a;">Editar</a>
                    <form action="{{ route('productos.destroy', $p->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>