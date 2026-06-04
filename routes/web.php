<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\InventarioController;
use Illuminate\Support\Facades\Route;

//LOGIN rutas normales
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// RECURSOS CRUD automático
Route::resource('productos', ProductoController::class)->middleware('auth');
Route::resource('ventas', VentaController::class)->middleware('auth');
Route::resource('compras', CompraController::class)->middleware('auth');

// INVENTARIO rutas especiales
Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index')->middleware('auth');
Route::get('/inventario/alertas', [InventarioController::class, 'alertas'])->name('inventario.alertas')->middleware('auth');
Route::get('/inventario/analisis', [InventarioController::class, 'analisis'])->name('inventario.analisis')->middleware('auth');

