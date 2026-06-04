<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Grupo Águila</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f0eb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: white;
            border-radius: 8px;
            border: 1px solid #d4c5b0;
        }
        .login-header {
            background-color: #6b4f3a;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }
        .login-body {
            padding: 30px;
        }
        .btn-login {
            background-color: #6b4f3a;
            color: white;
            width: 100%;
            border: none;
            padding: 10px;
        }
        .btn-login:hover {
            background-color: #8b5e3c;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="col-md-4">
            <div class="login-card">
                <div class="login-header">
                    <h4>Grupo Águila</h4>
                    <p>Vidrios y Aluminios</p>
                </div>
                <div class="login-body">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn-login">Iniciar Sesión</button>
                    </form>
                    <hr>
                    <small class="text-muted d-block text-center">admin@grupoaguila.com / Admin123</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>