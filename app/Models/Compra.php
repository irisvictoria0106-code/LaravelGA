<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'folio', 
        'fecha', 
        'producto_id', 
        'cantidad', 
        'precio_compra', 
        'proveedor', 
        'total', 
        'user_id'
    ];
    
    
    
    
}