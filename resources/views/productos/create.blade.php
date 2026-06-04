@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4>Crear Producto</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('productos.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label>Nombre del producto</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Cantidad (Stock)</label>
                        <input type="number" name="cantidad" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Precio de compra</label>
                        <input type="number" step="0.01" name="precio_compra" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Tipo de material</label>
                        <select name="tipo_material" class="form-control">
                            <option value="Vidrio">Vidrio</option>
                            <option value="Aluminio">Aluminio</option>
                            <option value="Accesorio">Accesorio</option>
                        </select>
                    </div>

                    <button class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection