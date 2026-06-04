<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();
        
        if ($request->has('buscar') && $request->buscar != '') {
            $query->where('nombre', 'like', '%' . $request->buscar . '%')
                  ->orWhere('codigo', 'like', '%' . $request->buscar . '%');
        }
        
        $productos = $query->paginate(10);
        return view('inventario.index', compact('productos'));
    }
    
    public function alertas()
    {
        $bajoStock = Producto::where('stock', '<=', 'stock_minimo')
                    ->where('stock', '>', 0)
                    ->paginate(10);
        
        $agotados = Producto::where('stock', 0)->paginate(10);
        
        return view('inventario.alertas', compact('bajoStock', 'agotados'));
    }
    
    public function analisis()
{
    $ventasPorMes = DB::table('ventas')
        ->select(DB::raw('MONTH(fecha) as mes'), DB::raw('SUM(total) as total'), DB::raw('COUNT(*) as cantidad'))
        ->groupBy(DB::raw('MONTH(fecha)'))
        ->orderBy('mes')
        ->get();
    
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    
    $productosMV = DB::table('venta_detalles')
        ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
        ->select('productos.nombre', 'productos.tipo_material', 'productos.categoria', DB::raw('SUM(venta_detalles.cantidad) as total_vendido'))
        ->groupBy('productos.id', 'productos.nombre', 'productos.tipo_material', 'productos.categoria')
        ->orderBy('total_vendido', 'desc')
        ->limit(10)
        ->get();
    
    $categoriaMasVendida = DB::table('venta_detalles')
        ->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')
        ->select('productos.tipo_material', DB::raw('SUM(venta_detalles.cantidad) as total'))
        ->groupBy('productos.tipo_material')
        ->orderBy('total', 'desc')
        ->first();
    
    $totalVentas = DB::table('ventas')->count();
    
    return view('inventario.analisis', compact('ventasPorMes', 'meses', 'productosMV', 'categoriaMasVendida', 'totalVentas'));
}
}