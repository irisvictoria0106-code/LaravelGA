<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%')
                  ->orWhere('codigo', 'like', '%' . $request->buscar . '%');
        }

        $productos = $query->paginate(10);

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required|numeric|min:0',
            'precio_compra' => 'required|numeric|min:0',
        ]);

        $precioCompra = $request->precio_compra;
        $precioVenta = round($precioCompra * 1.15, 2);

        Producto::create([
            'codigo' => 'PROD-' . str_pad(Producto::count() + 1, 4, '0', STR_PAD_LEFT),
            'nombre' => $request->nombre,
            'categoria' => 'General',
            'tipo_material' => $request->tipo_material ?? 'General',
            'stock' => $request->cantidad,
            'stock_minimo' => 5,
            'precio_compra' => $precioCompra,
            'precio_venta' => $precioVenta,
            'estado' => 'activo',
        ]);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto creado correctamente');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required|numeric|min:0',
            'precio_compra' => 'required|numeric|min:0',
        ]);

        $producto = Producto::findOrFail($id);

        $precioCompra = $request->precio_compra;
        $precioVenta = round($precioCompra * 1.15, 2);

        $producto->update([
            'nombre' => $request->nombre,
            'stock' => $request->cantidad,
            'tipo_material' => $request->tipo_material,
            'precio_compra' => $precioCompra,
            'precio_venta' => $precioVenta,
        ]);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}