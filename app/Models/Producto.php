<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    

    protected $fillable = [
        'codigo',
        'nombre',
        'categoria',
        'tipo_material',
        'stock',
        'stock_minimo',
        'precio_compra',
        'precio_venta',
        'estado'
    ];
}