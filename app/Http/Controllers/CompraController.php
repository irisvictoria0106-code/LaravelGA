<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        
        $compras = DB::table('compras')
            ->join('productos', 'compras.producto_id', '=', 'productos.id')
            ->select(
                'compras.id', 
                'productos.nombre as producto_nombre', 
                'compras.cantidad', 
                'compras.proveedor',
                'compras.fecha',
                'compras.created_at',
                'compras.total'
            )
            ->orderBy('compras.created_at', 'desc')
            ->get();
        
        return view('compras.index', compact('productos', 'compras'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'proveedor' => 'required|string|max:100',
        ]);
        
        $producto = Producto::findOrFail($request->producto_id);
        
        $precioUnitario = $producto->precio_compra > 0 ? $producto->precio_compra : 100;
        $total = $request->cantidad * $precioUnitario;
        
        DB::beginTransaction();
        
        try {
            Compra::create([
                'folio' => 'C-' . str_pad(Compra::count() + 1, 4, '0', STR_PAD_LEFT),
                'fecha' => $request->fecha,
                'producto_id' => $producto->id,
                'cantidad' => $request->cantidad,
                'precio_compra' => $precioUnitario,
                'proveedor' => $request->proveedor,
                'total' => $total,
                'user_id' => Auth::id(),
            ]);
            
            $producto->stock += $request->cantidad;
            $producto->save();
            
            DB::commit();
            return redirect()->route('compras.index')->with('success', 'Compra registrada correctamente');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al registrar compra: ' . $e->getMessage());
        }
    }
}