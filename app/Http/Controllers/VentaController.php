<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $productos = Producto::where('estado', 'activo')->where('stock', '>', 0)->get();
        
        $ventas = DB::table('ventas')
            ->join('venta_detalles', 'ventas.id', '=', 'venta_detalles.venta_id')
            ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
            ->select(
                'ventas.id', 
                'productos.nombre as producto_nombre', 
                'venta_detalles.cantidad', 
                'venta_detalles.subtotal as total', 
                'ventas.created_at'
            )
            ->orderBy('ventas.created_at', 'desc')
            ->get();
        
        return view('ventas.index', compact('productos', 'ventas'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);
        
        $producto = Producto::findOrFail($request->producto_id);
        
        if ($request->cantidad > $producto->stock) {
            return back()->with('error', 'Stock insuficiente');
        }
        
        DB::beginTransaction();
        
        try {
            $total = $request->cantidad * $producto->precio_venta;
            
            $venta = Venta::create([
                'folio' => 'V-' . str_pad(Venta::count() + 1, 4, '0', STR_PAD_LEFT),
                'fecha' => now(),
                'total' => $total,
                'metodo_pago' => 'efectivo',
                'notas' => null,
                'user_id' => Auth::id(),
            ]);
            
            VentaDetalle::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto->id,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $producto->precio_venta,
                'descuento' => 0,
                'subtotal' => $total,
            ]);
            
            $producto->stock -= $request->cantidad;
            $producto->save();
            
            DB::commit();
            return redirect()->route('ventas.index')->with('success', 'Venta registrada');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al registrar venta');
        }
    }
}