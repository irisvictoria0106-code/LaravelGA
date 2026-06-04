<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo Águila</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f0eb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            background-color: #6b4f3a;
            min-height: 100vh;
        }
        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            border-bottom: 1px solid #8b5e3c;
        }
        .sidebar .nav-link:hover {
            background-color: #8b5e3c;
        }
        .sidebar .nav-link.active {
            background-color: #8b5e3c;
            font-weight: bold;
        }
        .main-content {
            padding: 20px;
        }
        .navbar-top {
            background-color: white;
            padding: 15px 20px;
            margin-bottom: 20px;
            border: 1px solid #d4c5b0;
        }
        .card {
            border: 1px solid #d4c5b0;
            border-radius: 8px;
        }
        .card-header {
            background-color: #8b5e3c;
            color: white;
            font-weight: bold;
            border-bottom: none;
        }
        .btn-primary {
            background-color: #6b4f3a;
            border: none;
        }
        .btn-primary:hover {
            background-color: #8b5e3c;
        }
        .btn-secondary {
            background-color: #a89f91;
            border: none;
        }
        .btn-warning {
            background-color: #d4a373;
            border: none;
            color: white;
        }

        footer {
            text-align: center;
            padding: 15px;
            color: #8b5e3c;
            font-size: 12px;
            border-top: 1px solid #d4c5b0;
            margin-top: 30px;
        }
        table th {
            background-color: #6b4f3a;
            color: white;
        }
        .stock-bajo {
            background-color: #fff3e0;
        }
        .stock-agotado {
            background-color: #f8e0e0;
        }
        a {
            color: #6b4f3a;
            text-decoration: none;
        }
        a:hover {
            color: #8b5e3c;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-2 p-0 sidebar">
                <div class="text-center p-3">
                    <h5 class="text-white">Grupo Águila</h5>
                    <small class="text-white-50">Vidrios y Aluminios</small>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}" href="{{ route('productos.index') }}">Productos</a>
                    <a class="nav-link {{ request()->routeIs('ventas.*') ? 'active' : '' }}" href="{{ route('ventas.index') }}">Ventas</a>
                    <a class="nav-link {{ request()->routeIs('compras.*') ? 'active' : '' }}" href="{{ route('compras.index') }}">Compras</a>
                    <a class="nav-link {{ request()->routeIs('inventario.*') ? 'active' : '' }}" href="{{ route('inventario.index') }}">Inventario</a>
                </nav>
                <div class="p-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">Cerrar Sesión</button>
                    </form>
                </div>
            </div>

            <div class="col-md-10 p-0">
                <div class="main-content">
                    <div class="navbar-top d-flex justify-content-between">
                        <div>
                            <strong>Sistema de Gestión Comercial</strong><br>
                            Usuario: {{ Auth::user()->name }}
                        </div>
                        <div>{{ now()->format('d/m/Y') }}</div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @yield('content')
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>