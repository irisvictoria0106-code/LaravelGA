@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning">
                <h4>Editar Producto</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('productos.update', $producto->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Stock</label>
                        <input type="number" name="cantidad" value="{{ $producto->stock }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Precio de compra</label>
                        <input type="number" name="precio_compra" value="{{ $producto->precio_compra }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Tipo de material</label>
                        <select name="tipo_material" class="form-control">
                            <option value="Vidrio" {{ $producto->tipo_material=='Vidrio'?'selected':'' }}>Vidrio</option>
                            <option value="Aluminio" {{ $producto->tipo_material=='Aluminio'?'selected':'' }}>Aluminio</option>
                            <option value="Accesorio" {{ $producto->tipo_material=='Accesorio'?'selected':'' }}>Accesorio</option>
                        </select>
                    </div>

                    <button class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection